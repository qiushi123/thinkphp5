<?php
/**
 * 2019/10/3 15:48
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;

use app\api\model\OrderModel;
use app\lib\enum\OrderStatusEnum;
use app\lib\exception\OrderException;
use app\lib\exception\TokenException;
use think\Exception;
use think\Loader;
use think\Log;

//指向 extend/WxPay/WxPay.Api.php
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

class PayService {

    private $orderId;
    private $orderNo;

    /**
     * PayService constructor.
     * @param $orderId
     */
    public function __construct($orderId) {
        if (!$orderId) {
            throw new Exception('订单号不能为空');
        }
        $this->orderId = $orderId;
    }

    public function pay() {
        $this->checkOrderValid();
        $orderService = new OrderService();
        $status = $orderService->checkOrderStock($this->orderId);
        if (!$status['pass']) {
            return $status;
        }
        return $this->makeWXPreOrder($status['orderPrice']);
    }

    //获取微信支付预订单
    private function makeWXPreOrder($totalPrice) {
        $openid = TokenService::getTokenVar('openid');
        if (!$openid) {
            throw new TokenException();
        }
        $wxOrderData = new \WxPayUnifiedOrder();
        $wxOrderData->SetOut_trade_no($this->orderNo);
        $wxOrderData->SetTrade_type('JSAPI');
        $wxOrderData->SetTotal_fee($totalPrice * 100);
        $wxOrderData->SetBody('编程小石头');
        $wxOrderData->SetOpenid($openid);
        $wxOrderData->SetNotify_url('http://qq.com');
        return $this->getPaySignature($wxOrderData);

    }

    private function getPaySignature($wxOrderData) {
        $wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        if ($wxOrder['return_code'] != 'SUCCESS' ||
            $wxOrder['result_code'] != 'SUCCESS') {
            Log::record($wxOrder, 'error');
            Log::record('获取预支付订单失败', 'error');
        }
        return $wxOrder;
    }

    private function checkOrderValid() {
        $order = OrderModel::where('id', '=', $this->orderId)
            ->find();
        //1，检测订单是否存在
        if (!$order) {
            throw new OrderException();
        }
        //2，检测订单用户是否匹配
        if (!TokenService::isValidOperate($order->user_id)) {
            throw new TokenException([
                'msg' => '订单与用户不匹配',
                'errCode' => 10003
            ]);
        }
        //3，检测订单是否已支付
        if ($order->status != OrderStatusEnum::UNPAID) {
            throw new OrderException([
                'code' => 403,
                'msg' => '订单已支付过了',
                'errCode' => 80003
            ]);
        }
        $this->orderNo = $order->order_no;
        return true;
    }


}