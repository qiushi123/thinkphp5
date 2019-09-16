<?php


namespace app\lib\exception;


use Throwable;

class ParamException extends BaseException {
    public $code = 400;
    public $msg = '参数错误';
    public $errCode = 10000;

    public function __construct($params = []) {
        if (!is_array($params)) {
            return;
        }
        if (array_key_exists('code', $params)) {
            $this->code = $params['code'];
        }
        if (array_key_exists('msg', $params)) {
            $this->msg = $params['msg'];
        }
        if (array_key_exists('errCode', $params)) {
            $this->errCode = $params['errCode'];
        }
    }


}