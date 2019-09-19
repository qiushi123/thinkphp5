<?php
/**
 * 2019/9/18 08:49
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\model;


use think\Model;

class ImageModel extends BaseModel {
    protected $table = 'image';
    //只显示那些属性
    protected $visible = ['id', 'url'];

    public function getUrlAttr($value, $data) {
        return $this->UrlPreFix($value, $data);

    }
}