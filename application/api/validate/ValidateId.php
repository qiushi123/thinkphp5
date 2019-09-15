<?php

/*
 * 校验id的正确性
 * 必须大于0的整数
 * */

namespace app\api\validate;


use think\Validate;

class ValidateId extends BaseValidate
{

    protected $rule = [
        'id' => 'require|isInteger'
    ];

    protected function isInteger($value, $rule = '', $data = '', $field = '')
    {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return $field . '必须是大于0的整数';
        }
    }
}