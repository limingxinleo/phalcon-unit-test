<?php
// +----------------------------------------------------------------------
// | PregTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
declare(ticks=1);

namespace Tests\Others;

use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class TicketTest extends UnitTestCase
{
    public $count = 0;

    public $testEmpty;

    public function testTickCount()
    {
        register_tick_function([$this, 'doTick']);
        $this->assertEquals(1, $this->count);
        if (version_compare(PHP_VERSION, '7.0', '>=')) {
            $this->assertEquals(2, $this->count);
            if (true) {
                $this->assertEquals(3, $this->count);
            }
            sleep(1);
            $this->assertEquals(5, $this->count);
            if (!empty($this->testEmpty)) {
                $this->assertEquals(6, $this->count);
            }
            if (false) {
            }
            $this->assertEquals(7, $this->count);
            if (false || !empty($this->testEmpty)) {
                echo 1;
            }
            $this->assertEquals(8, $this->count);
            if (false || !empty($this->testEmpty)) {
            }
            $this->assertEquals(10, $this->count);
            if ($this->retFalse()) {
                echo 1;
            }
            $this->assertEquals(11, $this->count);
            $this->assertEquals(12, $this->count);
            if (true) {
            }
            $this->assertEquals(14, $this->count);
        }
    }

    public function doTick()
    {
        $this->count++;
    }

    public function retFalse()
    {
        return false;
    }
}
