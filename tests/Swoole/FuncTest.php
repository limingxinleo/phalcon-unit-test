<?php
// +----------------------------------------------------------------------
// | 基础测试类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units;

use App\Common\Clients\Rpc\BasicClient;
use App\Common\Clients\TestClient;
use App\Utils\Redis;
use Phalcon\Text;
use Tests\UnitTestCase;
use swoole_client;

/**
 * Class UnitTest
 */
class FuncTest extends UnitTestCase
{
    public function testSwooleGetLocalIp()
    {
        $this->assertTrue(count(swoole_get_local_ip()) > 0);
    }

    // public function testSwooleCpuNum()
    // {
    //     $this->assertTrue(count(swoole_cpu_num()) > 0);
    // }

    public function testSwooleVersion()
    {
        $this->assertTrue(version_compare(swoole_version(), '1.0', '>'));
    }
}
