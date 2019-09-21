<?php
/**
 * 2019/9/19 09:13
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


class ProductModel extends BaseModel {
    protected $table = 'product';
    protected $hidden = ["pivot", 'category_id', "delete_time", "create_time", "update_time"];

    //图片url拼接 main_img_url
    public function getMainImgUrlAttr($value, $data) {
        return $this->UrlPreFix($value, $data);

    }

    /*
     * 获取最新的新品
     * */
    public static function getRecentProduct($count) {
        return self::limit($count)
            ->order('create_time desc')
            ->select();
    }

    /*
     * 获取某一个分类下的所有商品
     * */
    public static function getAllProductByCategoryId($id) {
        return self::where('category_id', '=', $id)
            ->select();
    }
}