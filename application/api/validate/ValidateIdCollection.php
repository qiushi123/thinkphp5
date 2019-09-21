<?php
/**
 * 2019/9/21 10:33
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\validate;


class ValidateIdCollection extends BaseValidate {

    //定义校验规则
    protected $rule = [
        'ids' => 'require|checkIDs'
    ];

    protected $message = [
        'ids' => 'ids必须是以，分割的一串数字'
    ];
    protected function checkIDs($value) {
        $value = explode(',', $value);
        if (empty($value)) {
            return false;
        }
        foreach ($value as $id) {
            if (!$this->isInteger($id)) {
                return false;
            }
        }
        return true;
    }


}