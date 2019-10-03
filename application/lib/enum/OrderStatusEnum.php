<?php
/**
 * 2019/10/3 19:36
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\lib\enum;


class OrderStatusEnum {
    const UNPAID = 1;//未支付
    const PAID = 2;//已支付
    const DELIVERED = 3;//已发货
    const PAID_BUT_OUT_OF = 4;//已支付，但库存不足

}