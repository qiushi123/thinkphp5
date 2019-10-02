<?php
/**
 * 2019/10/2 16:38
 * author: 编程小石头
 * wechat:2501902696
 * desc:下单相关
 */

namespace app\api\controller\v1;


use app\api\service\TokenService;
use app\api\validate\OrderValidate;

class Order extends BaseController {

    //前置方法
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder() {
        (new OrderValidate())->goCheck();
        //1，用户下单，提交商品相关信息
        $products = input('post.products/a');
        $uid = TokenService::getUserId();
        //2,检测库存
        //3，下单成功
        //4，调用支付接口，还要再次检测库存
        //5，调用支付接口进行支付
        //6，根据微信返回的支付结果做对应处理
        return 'ok';
    }
}