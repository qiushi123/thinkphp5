<?php
/**
 * 2019/10/2 09:15
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

namespace app\api\controller\v1;


use app\api\model\UserModel;
use app\api\service\TokenService;
use app\api\validate\AddressValidate;
use app\lib\exception\UserException;
use app\lib\result\SuccessResult;

class Address {

    public function createOrUpdateAddress() {
        $addressValidate = new AddressValidate();
        $addressValidate->goCheck();
        //1,根据token获取用户uid
        $uid = TokenService::getUserId();
        //2，根据uid查找用户是否存在，不存在抛出异常
        $user = UserModel::get($uid);
        if (!$user) {
            throw new UserException();
        }
        //3，获取用户提交的信息
        $dataArr = $addressValidate->geDataByRule(input('post.'));
        //4，更新或者添加地址,不存在就添加，存在就更新
        $userAddress = $user->address;
        if (!$userAddress) {
            $user->address()->save($dataArr);
        } else {
            $user->address->save($dataArr);
        }
        return new SuccessResult();
    }
}