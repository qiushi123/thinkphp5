<?php
/**
 * 2019/10/4 17:45
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\validate;


class PagingValidate extends BaseValidate {
//校验商品数组里的每个商品
    protected $rule = [
        'page' => 'isInteger',
        'size' => 'isInteger'
    ];
    protected $message = [
        'page' => '分页参数必须是正整数',
        'size' => '分页size参数必须是正整数'
    ];
}