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

    //自动写入时间戳
    protected $autoWriteTimestamp = true;

    //定义读取器，用来格式化商品为json
    public function getSnapItemsAttr($value) {
        if (empty($value)) {
            return null;
        }
        return json_decode($value);
    }

    //定义读取器，用来格式化地址为json
    public function getSnapAddressAttr($value) {
        if (empty($value)) {
            return null;
        }
        return json_decode($value);
    }

    //获取某个用户的订单（分页）
    public static function getSummaryByUser($uid, $page = 1, $size = 15) {
        $pagingData = self::where('user_id', '=', $uid)
            ->order('create_time desc')
            ->paginate($size, true, ['page' => $page]);
        return $pagingData;
    }

}