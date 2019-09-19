<?php


namespace app\api\controller\v2;


use app\api\model\BannerModel;
use app\api\validate\ValidateId;
use think\Exception;
use think\Request;

class Banner {
    public function getBanner(Request $request) {
        return 'api第2个版本';
    }
}