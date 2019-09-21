<?php


namespace app\lib\exception;


use Throwable;

class ParamException extends BaseException {
    public $code = 400;
    public $msg = '参数错误';
    public $errCode = 10000;




}