<?php
/**
 * 2019/9/21 16:58
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;


use app\api\model\UserModel;
use app\lib\exception\TokenException;
use app\lib\exception\WeChatException;
use think\Exception;

class UserService extends TokenService {

    protected $code;
    protected $wxAppID;
    protected $wxAppSecret;
    protected $wxLoginUrl;

    function __construct($code) {
        $this->code = $code;
        $this->wxAppID = config('wx.app_id');
        $this->wxAppSecret = config('wx.app_secret');
        $this->wxLoginUrl = sprintf(
            config('wx.login_url'), $this->wxAppID, $this->wxAppSecret, $this->code);
    }

    /*
     * 获取小程序用户openid
     * */
    public function getToken() {
        $result = curl_get($this->wxLoginUrl);
        $wxResult = json_decode($result, true);
        if (empty($wxResult)) {
            throw  new Exception('获取openid时异常，微信内部错误');
        } else {
            $loginFail = array_key_exists('errcode', $wxResult);
            if ($loginFail) {//调用失败
                $this->processLoginErr($wxResult);
            } else {
                return $this->grantToken($wxResult);
            }
        }
    }


    private function grantToken($wxResult) {
        //1，拿到openid
        $openid = $wxResult['openid'];
        //2，数据库里查看是否存在
        $user = UserModel::getByOpenId($openid);
        if ($user) {
            $uid = $user->id;
        } else {
            //3，如果不存在，就创建user并获取uid
            $uid = UserModel::create(['openid' => $openid])->id;
        }
        //4，准备缓存数据，并写入缓存
        $cacheValue = $this->prepareCacheValue($wxResult, $uid);
        $token = $this->saveToCache($cacheValue);
        return $token;

    }

    //保存token
    private function saveToCache($cacheValue) {
        //1,获取token作为key
        $key = self::generateToken();
        $value = json_encode($cacheValue);
        //2，设置缓存过期时间，并把数据存到缓存
        $tokenTime = config('setting.token_time');
        $request = cache($key, $value, $tokenTime);
        if (!$request) {
            throw new TokenException([
                'msg' => '服务器缓存异常',
                'errCode' => 10005
            ]);
        }
        return $key;
    }

    private function prepareCacheValue($wxResult, $uid) {
        $cacheValue = $wxResult;
        $cacheValue['uid'] = $uid;
        $cacheValue['scope'] = 16;
        return $cacheValue;
    }

    //登录失败
    private function processLoginErr($wxInfo) {
        throw new WeChatException([
            'msg' => $wxInfo['errmsg'],
            'errCode' => $wxInfo['errcode']
        ]);
    }
}