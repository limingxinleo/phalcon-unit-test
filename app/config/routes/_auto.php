<?php
// +----------------------------------------------------------------------
// | web.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------

$router->add('/:controller/:action/:params', [
    'namespace' => 'App\Controllers',
    'controller' => 1,
    'action' => 2,
    'params' => 3,
]);

$router->add('/:controller', [
    'namespace' => 'App\Controllers',
    'controller' => 1
]);

$router->add('/api/index', 'App\\Controllers\\Api\\Index::index');
$router->add('/api/index/upload', 'App\\Controllers\\Api\\Index::upload');
$router->add('/api/index/middleware', 'App\\Controllers\\Api\\Index::middleware');