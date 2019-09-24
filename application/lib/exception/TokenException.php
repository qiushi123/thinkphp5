<?php
/**
 * 2019/9/24 09:00
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\exception;


class TokenException extends BaseException {
    public $code = "400";
    public $msg = 'token过期或无效';
    public $errCode = '10001';
}