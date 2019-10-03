<?php
/**
 * 2019/10/3 09:19
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\exception;


class OrderException extends BaseException {
    public $code = "403";
    public $msg = '订单不存在，请检测下单商品id';
    public $errCode = '80001';
}