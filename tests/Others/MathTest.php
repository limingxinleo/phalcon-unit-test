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

class MathTest extends UnitTestCase
{
    /**
     * @desc   绝对值
     * @author limx
     */
    public function testMathAbs()
    {
        $this->assertEquals(4.2, abs(-4.2));
        $this->assertEquals(4.2, abs(4.2));
    }

    /**
     * @desc   进一法取整
     * @author limx
     */
    public function testMathCeil()
    {
        $this->assertEquals(9, ceil(8.9));
        $this->assertEquals(9, ceil(8.5));
        $this->assertEquals(9, ceil(8.3));
        $this->assertEquals(-8, ceil(-8.3));
        $this->assertEquals(-8, ceil(-8.9));
    }

    /**
     * @desc   舍去法取整
     * @author limx
     */
    public function testMathFloor()
    {
        $this->assertEquals(8, floor(8.9));
        $this->assertEquals(8, floor(8.5));
        $this->assertEquals(8, floor(8.3));
        $this->assertEquals(-9, floor(-8.3));
        $this->assertEquals(-9, floor(-8.9));
    }

    /**
     * @desc   n次方
     * @author limx
     */
    public function testMathPow()
    {
        $this->assertEquals(8, pow(2, 3));
        $this->assertEquals(16, pow(2, 4));
        $this->assertEquals(1024, pow(2, 10));
    }

    public function testMathCompare()
    {
        $id = 101 - 99 > 0 ?: 0;
        $this->assertEquals(1, $id);

        $id = 99 - 990 > 0 ?: 0;
        $this->assertEquals(0, $id);
    }

    /**
     * @desc   四舍五入
     * @author limx
     */
    public function testMathRound()
    {
        $this->assertEquals(9, round(8.9));
        $this->assertEquals(9, round(8.5));
        $this->assertEquals(8, round(8.3));
        $this->assertEquals(-8, round(-8.3));
        $this->assertEquals(-9, round(-8.9));
        $this->assertEquals(-9, round(-8.5));
    }

    /**
     * @desc   平方根
     * @author limx
     */
    public function testMathSqrt()
    {
        $this->assertEquals(3, sqrt(9));
        $this->assertEquals(4, sqrt(16));
    }
}
