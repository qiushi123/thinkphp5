<?php
/**
 * 2019/9/21 15:36
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\exception;


class NoDataException extends BaseException {
    public $code = "404";
    public $msg = '查找的数据不存在，请检查参数';
    public $errCode = '10001';
}