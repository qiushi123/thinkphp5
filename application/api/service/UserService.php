<?php
/**
 * 2019/9/21 16:58
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;


use app\lib\exception\WeChatException;
use think\Exception;

class UserService {

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
                $this->grantToken($wxResult);
            }
        }
    }

    private function grantToken($wxResult) {
        $openid = $wxResult['openid'];
        echo $openid;
    }

    private function processLoginErr($wxInfo) {
        throw new WeChatException([
            'msg' => $wxInfo['errmsg'],
            'errCode' => $wxInfo['errcode']
        ]);
    }
}