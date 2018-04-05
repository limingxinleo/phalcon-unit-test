<?php
// +----------------------------------------------------------------------
// | PregTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Biz\Objects\Quote;
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
     * @desc   测试遍历引用的BUG ?? 已被修复 ??
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

    public function testArrayQuote()
    {
        Quote::getInstance()->getValues()['test'] = 'test';
        $this->assertEquals([], Quote::getInstance()->getValues());

        Quote::getInstance()->getValuesQuote()['test'] = 'test';
        $this->assertEquals(['test' => 'test'], Quote::getInstance()->getValues());
    }

    public function testObjectQuote()
    {
        $user = Quote::getInstance()->getObject();
        $user->name = 'limx2';

        $this->assertEquals($user, Quote::getInstance()->getObject());
    }

    public function testForeachWord()
    {
        $arr1 = [];
        for ($i = 'a'; $i <= 'z'; $i++) {
            $arr1[] = $i;
        }

        $arr2 = [];
        for ($i = ord('a'); $i <= ord('z'); $i++) {
            $arr2[] = $i;
        }

        $this->assertEquals(676, count($arr1));
        $this->assertEquals(26, count($arr2));
    }
}
