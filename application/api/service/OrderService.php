<?php
/**
 * 2019/10/2 21:54
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\service;


use app\api\model\ProductModel;

class OrderService {

    //用户订单里的商品列表
    protected $oProducts;
    //查询到的商品列表
    protected $products;
    protected $uid;

    public function place($uid, $oProducts) {
        $this->uid = $uid;
        $this->oProducts = $oProducts;
        $this->products = $this->getProductByOrder();
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
}