<?php

use think\Route;

//请求的baseurl：http://localhost:9001/public/
/*
 * api版本区分 v1   v2
 * http://localhost:9001/public/api/v1/banner/1
 * http://localhost:9001/public/api/v2/banner/1
 * */
Route::get('api/:v/banner/:id', 'api/:v.Banner/getBanner');
/*
 * http://localhost:9001/public/api/v1/theme/1
 * */
Route::get('api/:v/theme/:id', 'api/:v.Theme/getTheme');
