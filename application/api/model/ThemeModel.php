<?php
/**
 * 2019/9/19 09:14
 * author: 编程小石头
 * wechat:2501902696
 * desc: 主题专栏model层
 */

namespace app\api\model;


class ThemeModel extends BaseModel {
    protected $table = 'theme';
    protected $hidden = ['delete_time', 'update_time', 'head_img_id', 'topic_img_id'];

    public function topicImg() {
        return $this->belongsTo('ImageModel', 'topic_img_id', 'id');
    }

    public function headImg() {
        return $this->belongsTo('ImageModel', 'head_img_id', 'id');
    }

    /*
     * 多对多的查询
     * belongsToMany（目标模型，中间表名，目标表的id，中间表的id）
     * */
    public function products() {

        return $this->belongsToMany('ProductModel', 'theme_product', 'product_id', 'theme_id');
    }

    /*
     * 查询单个主题下的产品列表
     * */

    public static function getThemeProducts($id) {
        $theme = self::with('products,topicImg,headImg')->find($id);
        return $theme;
    }

    //模型的使用
    public static function getThemeById($id) {
        $result = self::select();
        return $result;
    }
}