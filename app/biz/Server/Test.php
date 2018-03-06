<?php
// +----------------------------------------------------------------------
// | Test.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Server;

use Xin\Swoole\Rpc\Handler\HanderInterface;
use Xin\Traits\Common\InstanceTrait;

class Test implements HanderInterface
{
    use InstanceTrait;

    public function getInteger()
    {
        return 1;
    }
}
