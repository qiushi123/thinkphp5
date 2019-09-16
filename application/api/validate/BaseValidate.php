<?php


namespace app\api\validate;


use app\lib\exception\ParamException;
use think\Request;
use think\Validate;

class BaseValidate extends Validate {

    public function goCheck() {
        $request = Request::instance();
        $params = $request->param();

        $result = $this->check($params);
        if ($result) {
            return true;
        } else {
            $e = new ParamException([
                'msg' => $this->error
            ]);
            throw  $e;
//            $err=$this->error;
//            throw  new Exception($err);
        }
    }
}