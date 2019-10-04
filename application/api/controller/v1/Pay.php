<?php
/**
 * 2019/10/3 15:40
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\controller\v1;


use app\api\service\PayService;
use app\api\service\WxNotifyService;
use app\api\validate\ValidateId;

class Pay extends BaseController {
    //前置方法,校验权限
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'placeOrder']
    ];

    public function getPreOrder($id = '') {
        (new ValidateId())->goCheck();
        $payService = new PayService($id);
        $result = $payService->pay();
        return $result;
    }

    public function receiveNotify() {
        $wxNotify = new WxNotifyService();
        $wxNotify->Handle();
    }
}