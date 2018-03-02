<?php
// +----------------------------------------------------------------------
// | AndOrTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use Tests\UnitTestCase;

class AndOrTest extends UnitTestCase
{
    public function testAndCase()
    {
        $a = bindec('1111');
        $b = bindec('0101');

        $c = $a & $b;
        $this->assertEquals('0101', decbin($c));
    }

    public function testOrCase()
    {
        $a = bindec('1111');
        $b = bindec('0101');

        $c = $a | $b;
        $this->assertEquals('1111', decbin($c));
    }

    public function testBitCase()
    {
        $dog = bindec('1');
        $cat = bindec('10');
        $bird = bindec('100');

        // 有猫有鸟
        $this->assertEquals('110', decbin($cat | $bird));

        // 全都有
        $all = $dog | $cat | $bird;
        $this->assertEquals('111', decbin($all));
        
        // 去掉狗
        $this->assertEquals('110', decbin($all & ~$dog));
    }
}
