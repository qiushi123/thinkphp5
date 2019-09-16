<?php


namespace app\lib\exception;


use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errCode;

    public function render(\Exception $e)
    {
        if ($e instanceof BaseException) {
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errCode = $e->errCode;
        } else {
            if (config('app_debug')) {//调试模式下，返回tp5异常，方便php开发者调试
                return parent::render($e);
            } else {
                $this->code = 500;
                $this->msg = '未知错误';
                $this->errCode = 999;
                $this->recordErrorLog($e);
            }

        }

        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errCode,
            'request_url' => $request->url()
        ];
        return json($result, $this->code);
    }

    private function recordErrorLog(\Exception $e)
    {
        //初始化自定义的日志记录
        Log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error'],
        ]);
        Log::record($e->getMessage(), 'error');
    }

}