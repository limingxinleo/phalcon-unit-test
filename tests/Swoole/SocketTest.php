<?php
// +----------------------------------------------------------------------
// | 基础测试类 [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units;

use Tests\UnitTestCase;
use swoole_client;

/**
 * Class UnitTest
 */
class SocketTest extends UnitTestCase
{
    public function testSocketSend()
    {
        $client = new swoole_client(SWOOLE_TCP | SWOOLE_KEEP);
        if (!$client->connect('127.0.0.1', 11520, 0.1)) {
            throw new RpcException("connect failed. Error: {$client->errCode}");
        }

        $data = 'xxxx';
        $client->send($data);
        $res = $client->recv();

        $this->assertEquals('receive:' . $data, $res);
    }
}
