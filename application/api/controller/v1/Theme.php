<?php
/**
 * 2019/9/19 09:12
 * author: 编程小石头
 * wechat:2501902696
 * desc: 主题专栏相关的接口
 */

namespace app\api\controller\v1;


use app\api\model\BannerModel;
use app\api\model\ThemeModel;
use app\api\validate\ValidateId;
use think\Exception;
use think\Request;

class Theme {
    public function getTheme($id) {
        (new ValidateId())->goCheck();
        $result = ThemeModel::getThemeById($id);
        if (!$result) {
//            throw  new BannerException();
            throw  new Exception('自定义错误日志');
        }
        return json($result);
    }
}