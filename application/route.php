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
