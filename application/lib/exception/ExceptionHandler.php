<?php


namespace app\lib\exception;


use think\Exception;
use think\exception\Handle;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errCode;

    public function render(Exception $e)
    {
        if ($e instanceof BaseException) {
            $this->code = $e ->code;
            $this->msg = $e->msg;
            $this->errCode = $e->errCode;
        } else {
            $this->code = '500';
            $this->msg='未知错误';
            $this->errCode=999;
        }

        $request=Request::instance();
        $result=[
            'msg'=>$this->msg,
            'error_code'=>$this->errCode,
            'request_url'=>$request->url()
        ];
        return json($result,$this->code);
    }
}