<?php
/**
 * 2019/9/21 16:47
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\validate;


class ValidateToken extends BaseValidate {

    protected $rule = [
        'code' => 'require|isNoEmpty',
//        'appId' => 'require|isNoEmpty',
//        'appSecret' => 'require|isNoEmpty'
    ];

    protected $message = [
        'code' => 'code为空或者格式不正确',
//        'appId' => 'appId为空或者格式不正确',
//        'appSecret' => 'appSecret为空或者格式不正确'
    ];
}