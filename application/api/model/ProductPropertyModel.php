<?php
/**
 * 2019/10/1 22:14
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


class ProductPropertyModel extends BaseModel {
    protected $table = 'product_property';
    protected $hidden = ['product_id','id',"delete_time", "update_time"];
}