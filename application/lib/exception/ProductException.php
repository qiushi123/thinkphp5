<?php
/**
 * 2019/9/21 14:55
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\exception;


class ProductException extends BaseException {
    public $code = "404";
    public $msg = '查找的商品不存在';
    public $errCode = '20000';
}