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

    //校验是不是一个手机号
    protected function isMobile($value) {
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //校验参数是不是正整数
    protected function isInteger($value, $rule = '', $data = '', $field = '') {
        if (is_numeric($value) && is_int($value + 0) && ($value + 0) > 0) {
            return true;
        } else {
            return false;
        }
    }

    //不为空
    protected function isNotEmpty($value, $rule = '', $data = '', $field = '') {
        if (empty($value) || strlen($value) < 1) {
            return false;
        } else {
            return true;
        }
    }

    //只获取定义过的参数
    public function geDataByRule($array) {
        if (array_key_exists('user_id', $array) ||
            array_key_exists('uid', $array)) {
            throw new ParamException([
                'msg' => '参数中包含非法的user_id或uid参数'
            ]);
        }
        $newArr = [];
        foreach ($this->rule as $key => $value) {
            $newArr[$key] = $array[$key];
        }
        return $newArr;
    }
}