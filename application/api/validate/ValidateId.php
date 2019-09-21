<?php

/*
 * 校验id的正确性
 * 必须大于0的整数
 * */

namespace app\api\validate;


use think\Validate;

class ValidateId extends BaseValidate {

    //ID必须是正整数
    protected $rule = [
        'id' => 'require|isInteger'
    ];

    protected $message = [
        'id' => 'id必须是正整数'
    ];


}