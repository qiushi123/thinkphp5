<?php


namespace app\api\model;


use think\Model;

class BannerModel extends Model {
    //指定当前模型对应那个数据表
    protected $table = "banner";

    //隐藏那些字段属性
    protected $hidden = ['delete_time', 'update_time'];

    //关联banner_item表
    public function items() {
        return $this->hasMany('BannerItemModel', 'banner_id', 'id');
    }

    public static function getBannerById($id) {
        //传统sql语句，不建议
        //$result = Db::query('select * from banner where id=?', [$id]);

        //常用的tp5查询
        //$result=Db::table('banner')->where('id','=',$id)->find();//只返回一条
        //$result = Db::table('banner')->where('id', '=', $id)->select();//只返多条，是个数组

        //闭包的方法
        //$result = Db::table('banner')
        //->where(function ($query) use ($id) {
        //     $query->where(('id','=',$id);
        //})
        //->find();

        //模型的使用
        $result = self::with(['items','items.img'])->find($id);

        return $result;
    }
}