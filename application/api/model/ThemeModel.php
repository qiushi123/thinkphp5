<?php
/**
 * 2019/9/19 09:14
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


class ThemeModel extends BaseModel {
    protected $table = 'theme';

    //模型的使用
    public static function getThemeById($id) {
        $result = self::select();
        return $result;
    }
}