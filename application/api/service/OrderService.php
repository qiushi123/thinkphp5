<?php
/**
 * 2019/10/2 21:54
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;


use app\api\model\OrderModel;
use app\api\model\OrderProductModel;
use app\api\model\ProductModel;
use app\api\model\UserAddressModel;
use app\lib\exception\OrderException;
use app\lib\exception\UserException;

class OrderService {

    //用户订单里的商品列表
    protected $oProducts;
    //查询到的商品列表
    protected $products;
    protected $uid;

    public function place($uid, $oProducts) {
        $this->uid = $uid;
        $this->oProducts = $oProducts;
        $this->products = $this->getProductByOrder($oProducts);

        //校验订单
        $status = $this->getOrderStatus();
        if (!$status['pass']) {
            $status['order_id'] = -1;
            return $status;
        }
        //开始创建订单，先创建订单快照
        $orserSnap = $this->snapOrder($status);
        $order = $this->createOrder($orserSnap);
        $order['pass'] = true;
        return $order;
    }

    //创建订单，并保存到数据库
    private function createOrder($snap) {
        try {
            $orderNum = $this->makeOrderNum();
            $order = new OrderModel();
            $order->user_id = $this->uid;
            $order->order_no = $orderNum;
            $order->total_price = $snap['orderPrice'];
            $order->total_count = $snap['totalCount'];
            $order->snap_img = $snap['snapImg'];
            $order->snap_name = $snap['snapName'];
            $order->snap_address = $snap['snapAddress'];
            $order->snap_items = json_encode($snap['pStatus']);
            $order->save();
            $orderId = $order->id;
            $create_time = $order->create_time;//动态的给订单商品添加订单号
            foreach ($this->oProducts as &$p) {
                $p['order_id'] = $orderId;
            }
            $orderProduct = new OrderProductModel();
            $orderProduct->saveAll($this->oProducts);
            return [
                'order_no' => $orderNum,
                'order_id' => $orderId,
                'create_time' => $create_time
            ];
        } catch (\Exception $e) {
            throw $e;
        }


    }

    //创建订单快照
    private function snapOrder($status) {
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => null,//用户下单的地址
            'snapName' => '',
            'snapImg' => ''
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];
        if (count($this->products) > 1) {
            $snap['snapName'] .= '等';
        }
        return $snap;
    }

    //获取用户下单地址
    private function getUserAddress() {
        $userAddress = UserAddressModel::where('user_id', '=', $this->uid)
            ->find();
        if (!$userAddress) {
            throw new UserException([
                'msg' => '用户收货地址不存在，下单失败',
                'errCode' => 60001
            ]);
        }
        return $userAddress->toArray();
    }

    //获取订单状态
    private function getOrderStatus() {
        $status = [
            'pass' => true,// 商品是否都存在
            'orderPrice' => 0,//订单总价
            'totalCount' => 0,//订单总数量
            'pStatusArray' => []// 订单详情
        ];
        //遍历用户上传的订单，校验商品
        foreach ($this->oProducts as $oProduct) {
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'], $this->products
            );
            //有一个商品不存在或者库存不足，整个订单下单失败
            if (!$pStatus['haveStock']) {
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
            $status['totalCount'] += $pStatus['count'];
            array_push($status['pStatusArray'], $pStatus);
        }
        return $status;
    }

    /*
     * 检测商品是否存在
     * */
    private function getProductStatus($oPid, $oCount, $products) {
        $pIndex = -1;
        $pStatus = [
            'id' => null,
            'haveStock' => false,//是否有库存
            'count' => 0,
            'name' => '',//商品名
            'totalPrice' => 0
        ];
        for ($i = 0; $i < count($products); $i++) {
            if ($oPid == $products[$i]['id']) {
                $pIndex = $i;
            }
        }
        if ($pIndex == -1) {
            throw new OrderException([
                'msg' => 'id为' . $oPid . '的商品不存在，订单创建失败'
            ]);
        } else {
            $product = $products[$pIndex];
            $pStatus['id'] = $product['id'];
            $pStatus['name'] = $product['name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;
            if ($product['stock'] - $oCount >= 0) {
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }

    //获取用户订单列表里的商品
    private function getProductByOrder($oProducts) {
        $oPids = [];
        foreach ($oProducts as $item) {
            array_push($oPids, $item['product_id']);
        }
        $products = ProductModel::all($oPids)
            ->visible(['id', 'price', 'stock', 'name', 'main_img_url'])
            ->toArray();
        return $products;
    }


    /*
     * 生成订单号
     * */
    public static function makeOrderNum() {
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn =
            $yCode[intval(date('Y')) - 2019] . strtoupper(dechex(date('m'))) . date(
                'd') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf(
                '%02d', rand(0, 99));
        return $orderSn;
    }

    /*
     * 对外提供的检测库存的方法
     * */
    public function checkOrderStock($orderId) {
        $oProducts = OrderProductModel::where('order_id', '=', $orderId)
            ->select();
        $this->oProducts = $oProducts;
        $this->products = $this->getProductByOrder($oProducts);
        $status = $this->getOrderStatus();
        return $status;
    }
}