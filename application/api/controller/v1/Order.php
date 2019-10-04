<?php
/**
 * 2019/10/2 16:38
 * author: 编程小石头
 * wechat:2501902696
 * desc:下单相关
 */

namespace app\api\controller\v1;


use app\api\model\OrderModel;
use app\api\service\OrderService;
use app\api\service\TokenService;
use app\api\validate\OrderValidate;
use app\api\validate\PagingValidate;
use app\api\validate\ValidateId;
use app\lib\exception\OrderException;

class Order extends BaseController {

    //前置方法
    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'placeOrder'],
        'checkPrimaryScope' => ['only' => 'getSummaryByUser,getDetail']
    ];

    public function placeOrder() {
        (new OrderValidate())->goCheck();
        //1，用户下单，提交商品相关信息
        $products = input('post.products/a');
        $uid = TokenService::getUserId();
        //2,检测库存
        $orderService = new OrderService();
        $status = $orderService->place($uid, $products);
        return $status;
        //3，下单成功
        //4，调用支付接口，还要再次检测库存
        //5，调用支付接口进行支付
        //6，根据微信返回的支付结果做对应处理
    }

    //分页获取用户订单
    public function getSummaryByUser($page = 1, $size = 15) {
        (new PagingValidate())->goCheck();
        $uid = TokenService::getUserId();
        $paginDatas = OrderModel::getSummaryByUser($uid, $page, $size);
        if (!$paginDatas) {
            return [
                'data' => [],
                'current_page' => $paginDatas->getCurrentPage()
            ];
        }
        $datas = $paginDatas
            ->hidden(['snap_items', 'snap_address', 'prepay_id'])
            ->toArray();
        return [
            'data' => $datas,
            'current_page' => $paginDatas->getCurrentPage()
        ];
    }

    //获取订单详情
    public function getDetail($id) {
        (new ValidateId())->goCheck();
        $orderDetail = OrderModel::get($id);
        if(!$orderDetail){
            throw new OrderException();
        }
        return $orderDetail->hidden(['prepay_id']);
    }
}