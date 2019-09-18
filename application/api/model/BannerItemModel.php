<?php
/**
 * 2019/9/18 08:47
 * author: 编程小石头
 * wechat:2501902696
 * desc:banner_item表对应的模型
 */

namespace app\api\model;


use think\Model;

class BannerItemModel extends Model {
    protected $table = 'banner_item';

    protected $hidden=['img_id','banner_id','delete_time','update_time'];
    //关联image表
    public function img() {
        return $this->belongsTo('ImageModel', 'img_id', 'id');
    }
}