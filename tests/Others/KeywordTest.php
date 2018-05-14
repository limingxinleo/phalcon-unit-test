<?php
// +----------------------------------------------------------------------
// | KeywordTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Biz\Test;
use App\Models\User;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class KeywordTest extends UnitTestCase
{
    public function testYieldString()
    {
        $res = Test::getInstance()->yieldString();

        foreach ($res as $key => $value) {
            $this->assertEquals(0, $key);
            $this->assertEquals('This is a keyword for yield.', $value);
        }
    }

    public function testYieldArray()
    {
        $res = Test::getInstance()->yieldArray();

        $result = [];
        foreach ($res as $key => $value) {
            $result[$key] = $value;
        }

        $this->assertEquals(['limx', 'Agnes'], $result);
    }

    public function testYieldSend()
    {
        $res = Test::getInstance()->yieldSend();
        $this->assertEquals('limx', $res->current());
        $this->assertEquals('xxx', $res->send('xxx'));
        $this->assertEquals('xxx', $res->current());
        $res->next();
        $this->assertEquals('Agnes', $res->current());
        $res->next();
        $this->assertEquals('xyz', $res->current());
    }

    public function testYieldObject()
    {
        $res = Test::getInstance()->yieldObject();

        foreach ($res as $key => $value) {
            $this->assertEquals(1, $value->id);
            $this->assertEquals('limx', $value->name);
        }
    }

    public function testYieldModel()
    {
        $res = Test::getInstance()->yieldModel();
        /** @var User $value */
        foreach ($res as $value) {
            $this->assertEquals(1, $value->id);
            $this->assertEquals('limx', $value->name);
        }
    }

    public function testYieldModels()
    {
        $res = Test::getInstance()->yieldModels();
        /** @var User $user */
        $user = $res->current();
        $this->assertEquals(1, $user->id);
        $this->assertEquals('limx', $user->name);

        $res->next();
        $user = $res->current();
        $this->assertEquals(2, $user->id);
        $this->assertEquals('Agnes', $user->name);
    }
}
