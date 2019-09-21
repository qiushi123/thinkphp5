<?php


namespace app\lib\exception;

class ThemeException extends BaseException {
    public $code = "404";
    public $msg = '请求de主题不存在';
    public $errCode = '30000';
}