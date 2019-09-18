<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]

// 定义应用目录
use think\Log;

define('APP_PATH', __DIR__ . '/../application/');
define('LOG_PATH', __DIR__ . '/../LOG/');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

//初始化自定义的日志记录
Log::init([
    'type' => 'File',
    'path' => LOG_PATH,
    'level' => ['sql'],
]);