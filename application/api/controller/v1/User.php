<?php
/**
 * 2019/9/21 16:46
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\controller\v1;


use app\api\validate\ValidateToken;

class User {

    public function getToken($code) {
        (new ValidateToken())->goCheck();
        return "ok";
    }
}