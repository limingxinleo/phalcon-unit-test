<?php
// +----------------------------------------------------------------------
// | AuthMiddleware.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Middleware;

use Closure;
use Xin\Phalcon\Middleware\Middleware;

class TestMiddleware extends Middleware
{
    public function handle($request, Closure $next)
    {
        if ($this->request->get('success') != true) {
            return $this->response->setJsonContent([
                'success' => false,
                'data' => $this->request->get()
            ]);
        }
        return $next($request);
    }
}
