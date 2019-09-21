<?php
/**
 * 2019/9/21 17:40
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\exception;


class WeChatException extends BaseException {
    public $code = "400";
    public $msg = '参数错误';
    public $errCode = '10001';
}