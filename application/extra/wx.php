<?php
/**
 * 2019/9/21 17:15
 * author: 编程小石头
 * wechat:2501902696
 * desc:
 */

return [
    'app_id' => 'wx3a9741a27fe04fd3',
    'app_secret' => 'a63506af33f46c5f44e3fa818b45f21d',
    'login_url' => 'https://api.weixin.qq.com/sns/jscode2session?appid=%s&secret=%s&js_code=%s&grant_type=authorization_code',
    'pay_back_url' => 'http://localhost:9001/thinkphp5/public/api/v1/pay/notify'//支付成功后的回调地址
];