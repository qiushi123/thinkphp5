<?php


namespace app\lib\exception;


class BaseException extends \Exception
{
    public $code = "400";
    public $msg = '参数错误';
    public $errCode = '10001';
}