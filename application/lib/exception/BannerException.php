<?php


namespace app\lib\exception;

class BannerException extends BaseException
{
    public $code = "404";
    public $msg='请求数据为空';
    public $errCode='10001';
}