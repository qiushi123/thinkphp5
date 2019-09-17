<?php


namespace app\api\model;


use think\Db;

class BannerModel {
    public static function getBannerById($id) {
        //传统sql语句，不建议
//        $result = Db::query('select * from banner where id=?', [$id]);

        //常用的tp5查询
//        $result=Db::table('banner')->where('id','=',$id)->find();//只返回一条
        $result = Db::table('banner')->where('id', '=', $id)->select();//只返多条，是个数组

        //闭包的方法
//        $result = Db::table('banner')
//            ->where(function ($query) use ($id) {
//                $query->where(('id','=',$id);
//            })
//            ->find();

        return $result;
    }
}