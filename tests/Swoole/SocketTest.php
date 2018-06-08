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
use Phalcon\Cache\BackendInterface;
use Phalcon\Text;
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

    public function testRpcServiceCase()
    {
        $this->assertEquals(
            di('config')->version,
            BasicClient::getInstance()->version()
        );
    }

    public function testRpcRedisGetStringCase()
    {
        $key = 'unit:swoole:string';
        $val = Text::random(10);
        Redis::set($key, $val);
        $this->assertEquals($val, BasicClient::getInstance()->getStringFromRedis($key));
    }

    public function testWorkProcess()
    {
        /** @var BackendInterface $cache */
        // $cache = di('cache');
        // $this->assertEquals('Hi, limx', $cache->get('another:task:save:cache'));

        $this->assertTrue(true);
    }
}
