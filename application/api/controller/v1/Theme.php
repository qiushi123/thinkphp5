<?php
/**
 * 2019/9/19 09:12
 * author: 编程小石头
 * wechat:2501902696
 * desc: 主题专栏相关的接口
 */

namespace app\api\controller\v1;


use app\api\model\ThemeModel;
use app\api\validate\ValidateId;
use app\api\validate\ValidateIdCollection;
use app\lib\exception\ThemeException;
use think\Exception;

class Theme {

    /*
     * 获取主题列表
     * url: /theme/?ids=1,2,3
     *
     * */
    public function getSimpleList($ids = '') {
        (new ValidateIdCollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')
            ->select($ids);
        if ($result->isEmpty()) {
            throw new ThemeException();
        }
        return $result;
    }

    /*
     * 获取某一个主题下的产品列表
     * @url /theme/:id
     * */
    public function getComplexOne($id) {
        (new ValidateId())->goCheck();
        $theme = ThemeModel::getThemeProducts($id);
        if ($theme->isEmpty()) {
            throw new ThemeException();
        }
        return $theme;
    }


    public function getTheme($id) {
        (new ValidateId())->goCheck();
        $result = Theme::getThemeById($id);
        if ($result->isEmpty()) {
//            throw  new BannerException();
            throw  new Exception('自定义错误日志');
        }
        return json($result);
    }
}