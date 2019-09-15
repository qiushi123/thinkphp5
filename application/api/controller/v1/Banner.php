<?php


namespace app\api\controller\v1;


use app\api\model\BannerModel;
use app\api\validate\ValidateId;
use app\lib\exception\BannerException;
use think\Request;

class Banner
{
    public function getBanner(Request $request)
    {
        (new ValidateId())->goCheck();
        $result = BannerModel::getBannerById(1);
        if (!$result) {
            throw  new BannerException();
        }
        return $result;
    }
}