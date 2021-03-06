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
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class ConfigTest extends UnitTestCase
{
    public function testConfigCase()
    {
        $version = di('config')->get('version');
        $this->assertEquals(System::getInstance()->version(), $version);
    }
}
