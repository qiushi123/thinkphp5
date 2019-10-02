<?php
/**
 * 2019/10/2 09:36
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\exception;


class UserException extends BaseException {
    public $code = "400";
    public $msg = '用户不存在';
    public $errCode = '10001';
}