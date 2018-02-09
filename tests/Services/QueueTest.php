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
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class QueueTest extends UnitTestCase
{
    public function testQueueCase()
    {
        for ($i = 1; $i <= 10; $i++) {
            Queue::delay(new TestJob(), $i);
        }
        for ($i = 0; $i < 10000; $i++) {
            Queue::push(new TestJob());
        }
    }
}
