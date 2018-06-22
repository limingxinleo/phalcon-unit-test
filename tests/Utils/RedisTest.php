<?php
// +----------------------------------------------------------------------
// | RedisTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Utils;

use App\Utils\Redis;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class RedisTest extends UnitTestCase
{
    public $prefix = 'unit:redis:';

    public function setUp()
    {
        $redisKeys = Redis::keys($this->prefix . '*');
        foreach ($redisKeys as $key) {
            Redis::del($key);
        }
        parent::setUp();
    }

    public function testRedisMultiExec()
    {
        Redis::multi();
        Redis::incr($this->prefix . 'num1');
        Redis::set($this->prefix . 'num2', 1);
        Redis::exec();

        $this->assertEquals(1, Redis::get($this->prefix . 'num1'));
        $this->assertEquals(1, Redis::get($this->prefix . 'num2'));
    }

    public function testRedisMultiDiscard()
    {
        Redis::multi();
        Redis::incr($this->prefix . 'num3');
        Redis::set($this->prefix . 'num4', 1);
        Redis::discard();

        $this->assertFalse(Redis::get($this->prefix . 'num3'));
        $this->assertFalse(Redis::get($this->prefix . 'num4'));
    }

    public function testRedisLRem()
    {
        $key = $this->prefix . 'queue';
        $data = json_encode(['last' => 'one']);
        Redis::lpush($key, $data);
        Redis::lpush($key, $data);
        Redis::lpush($key, $data);
        $this->assertEquals(3, Redis::llen($key));

        Redis::lrem($key, $data, 1);
        $this->assertEquals(2, Redis::llen($key));

        Redis::lrem($key, $data, 0);
        $this->assertEquals(0, Redis::llen($key));
        // 蛋疼，php72 php56返回0，php71 php70返回0
        $this->assertTrue(Redis::exists($key) == 0);
    }

    public function testRedisBrpopLpush()
    {
        $key1 = $this->prefix . 'queue1';
        $key2 = $this->prefix . 'queue2';

        $data = json_encode(['last' => 'one']);
        Redis::lpush($key1, $data);
        Redis::lpush($key1, $data);
        Redis::lpush($key1, $data);
        $this->assertEquals(3, Redis::llen($key1));
        $this->assertEquals(0, Redis::llen($key2));

        $data1 = Redis::brpoplpush($key1, $key2, 0);
        $this->assertEquals($data, $data1);
        $this->assertEquals(2, Redis::llen($key1));
        $this->assertEquals(1, Redis::llen($key2));

        $this->assertEquals(Redis::brpoplpush($key1, $key2, 0), Redis::brpoplpush($key1, $key2, 0));
        $this->assertEquals(0, Redis::llen($key1));
        $this->assertEquals(3, Redis::llen($key2));
    }

    public function testIncrWithExpireTime()
    {
        $key = 'unit:incr:time';
        Redis::del($key);

        $res = Redis::incr($key, 3600);
        $this->assertEquals(1, $res);

        $res = Redis::ttl($key);
        $this->assertEquals(3600, $res);
    }

    public function testRedisZAdd()
    {
        $key = 'unit:zadd';
        Redis::del($key);
        Redis::zadd($key, 1, 'a1', 2, 'a2');
        $res = Redis::zrange($key, 0, 1);
        $this->assertEquals(['a1', 'a2'], $res);

        $arr = ['a1' => 1, 'a2' => 2, 'a3' => 3];
        $input = [];
        foreach ($arr as $key => $score) {
            $input[] = $score;
            $input[] = $key;
        }
        Redis::del($key);
        Redis::zadd($key, ...$input);
        $res = Redis::zrange($key, 0, 2);
        $this->assertEquals(['a1', 'a2', 'a3'], $res);

        Redis::zadd($key, 2.5, 'a4');
        $res = Redis::zrange($key, 0, 3);
        $this->assertEquals(['a1', 'a2', 'a4', 'a3'], $res);
    }

    public function testRedisIncrMax()
    {
        Redis::set('test:incr', '9223372036854775807');
        $in = Redis::incr('test:incr');

        $this->assertFalse($in);
    }

    public function testRedisZRank()
    {
        $key = 'unit:zadd';
        Redis::del($key);
        Redis::zadd($key, 1, 'a1', 2, 'a2');
        $res = Redis::zrank($key, 'a1');
        $this->assertEquals(0, $res);
        $res = Redis::zrank($key, 'a2');
        $this->assertEquals(1, $res);
        $res = Redis::zrank($key, 'a3');
        $this->assertFalse($res);
    }
}
