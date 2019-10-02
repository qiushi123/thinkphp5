<?php
/**
 * 2019/10/1 22:13
 * author: 编程小石头
 * wechat:2501902696
 * desc:商品图片
 */

namespace app\api\model;


class ProductImageModel extends BaseModel {
    protected $table = 'product_image';
    protected $hidden = ['img_id', 'product_id', "delete_time", "update_time"];

    public function imgUrl() {
        return $this->belongsTo('ImageModel', 'img_id', 'id');
    }

}