<?php
// +----------------------------------------------------------------------
// | RedisTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Units;

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

    public function testMultiExec()
    {
        Redis::multi();
        Redis::incr($this->prefix . 'num1');
        Redis::set($this->prefix . 'num2', 1);
        Redis::exec();

        $this->assertEquals(1, Redis::get($this->prefix . 'num1'));
        $this->assertEquals(1, Redis::get($this->prefix . 'num2'));
    }

    public function testMultiDiscard()
    {
        Redis::multi();
        Redis::incr($this->prefix . 'num3');
        Redis::set($this->prefix . 'num4', 1);
        Redis::discard();

        $this->assertFalse(Redis::get($this->prefix . 'num3'));
        $this->assertFalse(Redis::get($this->prefix . 'num4'));
    }
}