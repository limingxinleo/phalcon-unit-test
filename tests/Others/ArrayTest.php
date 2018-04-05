<?php
// +----------------------------------------------------------------------
// | PregTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class ArrayTest extends UnitTestCase
{
    public function testArrayFlip()
    {
        $res = array_flip(['a', 'b', 'c']);

        $this->assertEquals(['a' => 0, 'b' => 1, 'c' => 2], $res);
    }

    public function testQuote()
    {
        $items = ['a', 'b', 'c'];
        foreach ($items as &$item) {
        }
        foreach ($items as $item) {
        }

        $this->assertEquals(['a', 'b', 'b'], $items);
    }

    /**
     * @desc 测试遍历引用的BUG ?? 已被修复 ??
     * @author limx
     */
    public function testForeachQuote()
    {
        $arr = [1, 2, 3];
        foreach ($arr as &$value) {
        }
        $this->assertEquals([1, 2, 3], $arr);
        foreach ($arr as &$value) {
        }
        $this->assertEquals([1, 2, 3], $arr);
    }
}
