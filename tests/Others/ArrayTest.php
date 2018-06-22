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
use App\Biz\Objects\Tree\JsonArray;
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
        if (version_compare(PHP_VERSION, '7.0', '>')) {
            // Quote::getInstance()->getValues()['test'] = 'test';
            // $this->assertEquals([], Quote::getInstance()->getValues());
            //
            // Quote::getInstance()->getValuesQuote()['test'] = 'test';
            // $this->assertEquals(['test' => 'test'], Quote::getInstance()->getValues());
        }

        $data = [10, 20];
        $r = &$data[1];
        $data2 = $data;
        $data2[1] = 30;

        $this->assertEquals(30, $r);
        $this->assertEquals(30, $data[1]);
        $this->assertEquals(30, $data2[1]);
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

    public function testArrayMerge()
    {
        $arr1 = [1, 2, 3];
        $arr2 = [4, 5, 6];
        $this->assertEquals([1, 2, 3, 4, 5, 6], array_merge($arr1, $arr2));
        $this->assertEquals([1, 2, 3], $arr1 + $arr2);

        $arr1 = ['a' => 1, 'b' => 2, 'c' => 3];
        $arr2 = ['b' => 4, 'c' => 5, 'd' => 6];
        $this->assertEquals(['a' => 1, 'b' => 4, 'c' => 5, 'd' => 6], array_merge($arr1, $arr2));
        $this->assertEquals(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 6], $arr1 + $arr2);
    }

    public function testArrayToTree()
    {
        $arr = [
            1 => ['id' => 1, 'pid' => 0],
            2 => ['id' => 2, 'pid' => 1],
            3 => ['id' => 3, 'pid' => 1],
            4 => ['id' => 4, 'pid' => 2],
            5 => ['id' => 5, 'pid' => 3],
        ];

        $jsonArray = new JsonArray($arr);
        $jsonArray->toTree();

        $result = $jsonArray->toArray();
        $this->assertEquals(
            '[{"id":1,"pid":0,"children":[{"id":2,"pid":1,"children":[{"id":4,"pid":2,"children":[]}]},{"id":3,"pid":1,"children":[{"id":5,"pid":3,"children":[]}]}]}]',
            json_encode($result)
        );
    }

    public function testArrayDiff()
    {
        $arr = [1, 2, 3, 4];
        $arr2 = [1, 2, 3];

        $res = array_diff($arr, $arr2);
        $this->assertEquals([3 => 4], $res);
        $res = array_diff($arr2, $arr);
        $this->assertEquals([], $res);
    }

    public function testUsort()
    {
        $arr = [['id' => 1], ['id' => 3], ['id' => 2]];
        usort($arr, function ($a1, $a2) {
            if ($a1['id'] === $a2['id']) return 0;
            return $a1['id'] < $a2['id'] ? -1 : 1;
        });

        $this->assertEquals([['id' => 1], ['id' => 2], ['id' => 3]], $arr);
    }

    public function testArrayMap()
    {
        $arr = null ?? [];
        $res = array_map(function () {
            return 1;
        }, $arr);

        $this->assertEquals([], $res);
    }
}
