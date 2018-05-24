<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');



// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',false);

// 定义应用目录
define('APP_PATH','./');

//绑定
define('BIND_MODULE','Home');
//定义前端公共文件
define('PUB_ROOT', '/Home/Public/');
define('PUB_JS', PUB_ROOT . 'js/');
define('PUB_CSS', PUB_ROOT . 'css/');
define('PUB_IMG', PUB_ROOT . 'images/');
define('PUB_LIB', PUB_ROOT . 'lib/');


//定义上传目录
define('UP_ROOT' , '/Upload/');
define('UP_PRO' , UP_ROOT. 'goods/');
define('UP_SYSTEM' , UP_ROOT. 'system/');




// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单



