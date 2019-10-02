<?php
/**
 * 2019/9/21 14:34
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\controller\v1;


use app\api\model\ProductModel;
use app\api\validate\ValidateCount;
use app\api\validate\ValidateId;
use app\lib\exception\NoDataException;
use app\lib\exception\ProductException;

class Product {

    /*
     * 获取最新的产品
     *
     * */
    public function getRecent($count = 15) {
        (new ValidateCount())->goCheck();
        $result = ProductModel::getRecentProduct($count);
        if ($result->isEmpty()) {
            throw new ProductException();
        }
        $result->hidden(['summary']);
        return $result;
    }

    /*
     *获取某一个分类下的所有商品
     * */
    public function getAllByCategory($id) {
        (new ValidateId())->goCheck();
        $result = ProductModel::getAllProductByCategoryId($id);
        if ($result->isEmpty()) {
            throw new NoDataException();
        }
        $result->hidden(['summary']);
        return $result;

    }

    /*
     * 获取商品详情页
     * */
    public function getOne($id){
        (new ValidateId())->goCheck();
        return ProductModel::getProductDetail($id);
    }
}