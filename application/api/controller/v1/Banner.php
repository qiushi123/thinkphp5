<?php


namespace app\api\controller\v1;


use app\api\model\BannerModel;
use app\api\validate\ValidateId;
use app\lib\exception\BannerException;
use think\Exception;
use think\Request;

class Banner
{
    public function getBanner(Request $request)
    {
        (new ValidateId())->goCheck();
        $result = BannerModel::getBannerById(1);
        if (!$result) {
//            throw  new BannerException();
            throw  new Exception('自定义错误日志');
        }
        return $result;
    }
}