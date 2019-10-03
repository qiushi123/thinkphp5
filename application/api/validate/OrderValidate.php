<?php
/**
 * 2019/10/2 21:41
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\validate;


use app\lib\exception\ParamException;

class OrderValidate extends BaseValidate {

    //校验订单里的商品数组
    protected $rule = [
        'products' => 'require|checkProducts'
    ];
    //校验商品数组里的每个商品
    protected $singleRule = [
        'product_id' => 'require|isInteger',
        'count' => 'require|isInteger'
    ];

    protected function checkProducts($values) {
        if (empty($values)) {
            throw new ParameterExceptt([
                'msg' => '商品列表不能为空'
            ]);
        }
        foreach ($values as $value) {
            $this->checkProduct($value);
        }
        return true;
    }

    private function checkProduct($value) {
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if (!$result) {
            throw new ParamException([
                'msg' => '商品列表参数错误',
            ]);
        }
    }
}