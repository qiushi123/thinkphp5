<?php
/**
 * 2019/9/24 08:48
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;


use app\lib\enum\ScopeEnum;
use app\lib\exception\TokenException;
use app\lib\exception\UserScopeException;
use think\Cache;
use think\Exception;
use think\Request;

class TokenService {


    //生成token
    public static function generateToken() {
        //1,生成32位随机字符串
        $randChars = getRandChar(32);
        //2,用三组字符串进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt = config('md5.token_salt');//一串随机的～盐
        return md5($randChars . $timestamp . $salt);
    }

    public static function getTokenVar($key) {
        $token = Request::instance()->header('token');
        $vars = Cache::get($token);
        if (!$vars) {
            throw new TokenException();
        } else {
            if (!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            //存在key
            if (array_key_exists($key, $vars)) {
                return $vars[$key];
            } else {
                throw new Exception('获取的toekn变量不存在');
            }
        }
    }

    //获取用户id
    public static function getUserId() {
        return self::getTokenVar('uid');
    }

    /*
     * 校验用户权限
     * */
    public static function needPrimaryScope() {
        $scope = self::getTokenVar('scope');
        if ($scope) {
            if ($scope >= ScopeEnum::USER) {
                return true;
            } else {
                throw new UserScopeException();
            }
        } else {
            throw new TokenException();
        }
    }
}