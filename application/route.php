<?php

use think\Route;

//请求的baseurl：http://localhost:9001/public/
//http://localhost:9001/public/banner/1
Route::get('banner/:id', 'api/v1.Banner/getBanner');
Route::get('hello', 'index/Index/test');
