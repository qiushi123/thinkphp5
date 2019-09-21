<?php
/**
 * 2019/9/21 15:38
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\controller\v1;


use app\api\model\CategoryModel;
use app\lib\exception\NoDataException;

class Category {

    /*
     * 查询所有分类
     * */
    public function getAllCategory() {
//        $result = CategoryModel::with('img')->select();
        //和上面的写法一样的
        $result = CategoryModel::all([], 'img');
        if ($result->isEmpty()) {
            throw new NoDataException();
        }
        $result->hidden(['description']);
        return $result;
    }
}