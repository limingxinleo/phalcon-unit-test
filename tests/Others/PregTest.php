<?php
// +----------------------------------------------------------------------
// | PregTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Common\Enums\ErrorCode;
use App\Common\Helper\Match;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class PregTest extends UnitTestCase
{
    public function testIsNumber()
    {
        $this->assertEquals(1, Match::getInstance()->isNumber(101));
        $this->assertEquals(1, Match::getInstance()->isNumber('101'));
        $this->assertEquals(0, Match::getInstance()->isNumber('0101'));
        $this->assertEquals(1, Match::getInstance()->isNumber('199'));
        $this->assertEquals(1, Match::getInstance()->isNumber(199));
        $this->assertEquals(1, Match::getInstance()->isNumber(-1222));
        $this->assertEquals(1, Match::getInstance()->isNumber('AAA'));
        $this->assertEquals(1, Match::getInstance()->isNumber('AAA0FF'));
        $this->assertEquals(1, Match::getInstance()->isNumber('-AAA0FF'));
        $this->assertEquals(0, Match::getInstance()->isNumber('-011AF'));
        $this->assertEquals(1, Match::getInstance()->isNumber('-11AF'));
        $this->assertFalse(is_numeric('AF'));
    }
}
