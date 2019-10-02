<?php
/**
 * 2019/10/2 09:16
 * author: 编程小石头
 * wechat:2501902696
 * desc:地址校验器
 */

namespace app\api\validate;


class AddressValidate extends BaseValidate {

    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty'
    ];
}