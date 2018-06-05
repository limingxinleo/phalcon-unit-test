<?php
// +----------------------------------------------------------------------
// | CallNext.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Objects;

class CallNext
{
    public function handle(array $request, callable $next)
    {
        $request['count']++;
        return $next($request);
    }
}