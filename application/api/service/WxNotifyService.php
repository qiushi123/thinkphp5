<?php
/**
 * 2019/10/4 16:41
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;

use app\api\model\OrderModel;
use app\api\model\ProductModel;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\DbException;
use think\Loader;
use think\Log;

//指向 extend/WxPay/WxPay.Api.php
Loader::import('WxPay.WxPay', EXTEND_PATH, '.Api.php');

//WxPayNotify 也是通过WxPay.Api.php来对外使用的
class WxNotifyService extends \WxPayNotify {

    public function NotifyProcess($data, &$msg) {
        if ($data['result_code'] == 'SUCCESS') {
            $orderNo = $data['out_trade_no'];

            //事物开始
            Db::startTrans();
            try {
                $order = OrderModel::where('order_no', '=', $orderNo)
                    ->lock(true)
                    ->find();
                if ($order->status == 1) {//还未支付
                    $orderService = new OrderService();
                    $status = $orderService->checkOrderStock($order->id);
                    if ($status['pass']) {//库存校验通过
                        $this->updateOrderStatus($order->id, true);//更新订单状态
                        $this->reduceStock($status);//减库存
                    } else {
                        $this->updateOrderStatus($order->id, false);//更新订单状态
                    }
                }
                //事物提交
                Db::commit();
                return true;
            } catch (Exception $e) {
                //事物回滚
                Db::rollback();
                Log::error($e);
                return false;
            }
        } else {
            return true;//失败了，返回true，告诉微信不用给我异步通知了
        }
    }

    //减库存
    private function reduceStock($status) {
        foreach ($status['pStatusArray'] as $item) {
            ProductModel::where('id', '=', $item['id'])
                ->setDec('stock', $item['count']);
        }
    }

    //更新订单状态
    private function updateOrderStatus($orderId, $success) {
        $status = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
        OrderModel::where('id', '=', $orderId)
            ->update(['status' => $status]);
    }

}