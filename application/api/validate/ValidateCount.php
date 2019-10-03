<?php

/*
 * 校验id的正确性
 * 必须大于0的整数
 * */

namespace app\api\validate;


class ValidateCount extends BaseValidate {

    //ID必须是正整数
    protected $rule = [
        'count' => 'isInteger|between:1,15'
    ];

    protected $message = [
        'count' => 'id必须是1~15之间的正整数'
    ];


}