<?php
/**
 * 2019/9/19 08:52
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


use think\Model;

class BaseModel extends Model {


    //补全图片链接
    protected function UrlPreFix($value, $data) {
        $finalUrl = $value;
        //form：1内部图片，2外部图片
        if ($data['from'] == 1) {
            $finalUrl = config('setting.img_prefix') . $value;
        }
        return $finalUrl;
    }
}