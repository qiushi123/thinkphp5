<?php
/**
 * 2019/9/24 08:48
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;


class TokenService {


    public static function generateToken() {
        //1,生成32位随机字符串
        $randChars = getRandChar(32);
        //2,用三组字符串进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        $salt = config('md5.token_salt');//一串随机的～盐
        return md5($randChars.$timestamp.$salt);
    }
}