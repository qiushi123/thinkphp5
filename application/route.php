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
 * */
Route::get('api/:v/product/:count', 'api/:v.Product/getRecent');
Route::get('api/:v/product/byCategory/:id', 'api/:v.Product/getAllByCategory');

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
