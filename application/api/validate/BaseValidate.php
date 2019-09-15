<?php


namespace app\api\validate;


use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends Validate
{

    public function goCheck(){
        $request=Request::instance();
        $params=$request->param();

        $result=$this->check($params);
        if($result){
            return true;
        }else{
            $err=$this->error;
            throw  new Exception($err);
        }
    }
}