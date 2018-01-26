<?php
// +----------------------------------------------------------------------
// | Enums.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use SayHello\Test;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class ComposerGitTest extends UnitTestCase
{
    public function testGetMessage()
    {
        $this->assertEquals('Hello World From Github', Test::getInstance()->say());
    }
}
