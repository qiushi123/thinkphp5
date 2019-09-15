<?php

/*
 * 参数验证器
 *
 * */

namespace app\api\validate;


use think\Validate;

class TestValidate extends Validate
{
    protected $rule=[
        'name'=>'require|max:10',
        'email'=>'email'
    ];

}