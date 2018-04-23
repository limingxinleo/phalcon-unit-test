<?php
// +----------------------------------------------------------------------
// | ConfigTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Services;

use App\Core\System;
use App\Jobs\TestJob;
use App\Utils\Queue;
use App\Utils\Redis;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class QueueTest extends UnitTestCase
{
    public function testQueueCase()
    {
        Redis::del('php:unit:incr');
        for ($i = 0; $i < 50; $i++) {
            Queue::push(new TestJob());
        }
        sleep(5);
        $this->assertEquals(50, Redis::get('php:unit:incr'));
    }
}
