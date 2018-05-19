<?php
// +----------------------------------------------------------------------
// | BasicService.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Service;

use App\Utils\Redis;
use Xin\Swoole\Rpc\Handler\Handler;

class BasicService extends Handler
{
    public function version()
    {
        return di('config')->version;
    }

    public function getStringFromRedis($key)
    {
        return Redis::get($key);
    }
}
