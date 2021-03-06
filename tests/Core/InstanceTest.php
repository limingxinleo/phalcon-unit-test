<?php
// +----------------------------------------------------------------------
// | CacheTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Core;

use App\Biz\Instance\Ins1;
use App\Biz\Instance\Ins2;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class InstanceTest extends UnitTestCase
{
    public function testBaseCase()
    {
        $this->assertEquals('Ins1', Ins1::getInstance()->str());
        $this->assertEquals('Ins2', Ins2::getInstance()->str());

        $ins1 = Ins1::getInstance();
        $this->assertEquals($ins1, Ins1::getInstance());
        $this->assertEquals($ins1, Ins1::getInstance()->instance());
    }
}
