<?php
/**
 * 2019/9/21 15:38
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


class CategoryModel extends BaseModel {
    protected $table = 'category';
    protected $hidden = ["delete_time", "update_time"];

    public function img() {
        return $this->belongsTo('ImageModel', 'topic_img_id', 'id');
    }


}