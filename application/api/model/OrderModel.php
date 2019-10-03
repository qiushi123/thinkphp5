<?php
/**
 * 2019/10/3 10:01
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


class OrderModel extends BaseModel {
    protected $table = 'order';
    protected $hidden = ['user_id', 'delete_time', 'update_time'];

}