<?php

use think\Route;

//请求的baseurl：http://localhost:9001/public/

/*
 * 轮播图banner
 * api版本区分 v1   v2
 * http://localhost:9001/public/api/v1/banner/1
 * http://localhost:9001/public/api/v2/banner/1
 * */
Route::get('api/:v/banner/:id', 'api/:v.Banner/getBanner');
/*
 * 主题专栏相关
 * http://localhost:9001/public/api/v1/theme/?ids=1,2,3
 * http://localhost:9001/public/api/v1/theme/?ids=1,2,3
 * */
Route::get('api/:v/theme', 'api/:v.Theme/getSimpleList');
Route::get('api/:v/theme/:id', 'api/:v.Theme/getComplexOne');

/*
 * 商品相关
 * http://localhost:9001/public/api/v1/product/count=10 获取最新10条产品
 * http://localhost:9001/public/api/v1/product/byCategory?id=2  获取某一个分类下所有商品
 * http://localhost:9001/public/api/v1/product/detail/2  获取商品详情
 * */
Route::group('api/:v/product', function () {
    Route::get('/:count', 'api/:v.Product/getRecent');
    Route::get('/byCategory/:id', 'api/:v.Product/getAllByCategory');
    Route::get('/detail/:id', 'api/:v.Product/getOne');
});


/*
 * 分类相关
 * http://localhost:9001/public/api/v1/category/all 获取所有de分类
 * */
Route::get('api/:v/category/all', 'api/:v.Category/getAllCategory');

/*
 * 用户相关
 * http://localhost:9001/public/api/v1/user/token?code='' 通过code值获取token
 * */
Route::post('api/:v/user/token', 'api/:v.User/getToken');

/*
 * 地址相关
 * http://localhost:9001/public/api/v1/address/add 添加或者更新地址
 * */
Route::post('api/:v/address/add', 'api/:v.Address/createOrUpdateAddress');

/*
 * 订单相关
 *http://localhost:9001/public/api/v1/order 订单
 * */
Route::post('api/:v/order', 'api/:v.Order/placeOrder');


