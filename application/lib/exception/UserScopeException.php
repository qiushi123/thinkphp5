<?php
/**
 * 2019/10/2 16:33
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\exception;


class UserScopeException extends BaseException {
    public $code = "403";
    public $msg = '用户权限不够';
    public $errCode = '10001';
}