<?php
/**
 * 2019/9/21 16:46
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


class UserModel extends BaseModel {
    protected $table = 'user';

    //user表关联user_address表
    public function address() {
        /*
         * hasOne 和belongsTo是对应的
         * hasOne 代表user_address中有user的关联键user_id
         * belongsTo    代表user有user_address的外键盘
         * */
        return $this->hasOne('UserAddressModel', 'user_id', 'id');
    }

    public static function getByOpenId($openid) {
        $user = self::where('openid', '=', $openid)
            ->find();
        return $user;
    }
}