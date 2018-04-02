<?php
// +----------------------------------------------------------------------
// | 控制器基类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Controllers;

use App\Utils\Request;

abstract class Controller extends \Phalcon\Mvc\Controller
{
    public function initialize()
    {
    }

    public function beforeExecuteRoute()
    {
        // 在每一个找到的动作前执行
        /** @var \Phalcon\Logger\AdapterInterface $logger */
        $logger = di('logger')->getLogger('request');
        $message = $this->request->getURI() . PHP_EOL;
        $message .= json_encode(Request::get()) . PHP_EOL;
        $message .= json_encode($this->request->getHeaders()) . PHP_EOL;
        $logger->info($message);
    }

    public function afterExecuteRoute()
    {
        // 在每一个找到的动作后执行
    }
}
