<?php


namespace app\api\controller\v1;


use app\api\model\BannerModel;
use app\api\validate\ValidateId;
use think\Exception;
use think\Request;

class Banner {
    public function getBanner($id) {
        (new ValidateId())->goCheck();
        $result = BannerModel::getBannerById($id);
        if (empty($result)) {
//            throw  new BannerException();
            throw  new Exception('自定义错误日志');
        }
        return $result;
    }
}