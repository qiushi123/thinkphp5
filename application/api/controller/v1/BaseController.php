<?php
/**
 * 2019/10/2 11:14
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\controller\v1;


use app\api\service\TokenService;
use think\Controller;

class BaseController extends Controller {

    /*
     * 校验用户权限
     * */
    public function checkPrimaryScope() {
        TokenService::needPrimaryScope();
    }
}