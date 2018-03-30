<?php
// +----------------------------------------------------------------------
// | SerializeTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Models\User;
use Phalcon\Forms\Element\Text;
use Tests\UnitTestCase;

class SerializeTest extends UnitTestCase
{
    public function testSerialize()
    {
        $obj = User::findFirst(1);

        $res = serialize($obj);

        $this->assertEquals($obj->id, unserialize($res)->id);
        $this->assertNotEquals($obj, unserialize($res));
    }

    public function testSerializationOfClosureIsNotAllowed()
    {
        try {
            serialize(function () {
                echo 1;
            });
        } catch (\Exception $ex) {
            $this->assertEquals("Serialization of 'Closure' is not allowed", $ex->getMessage());
        }
    }

    public function testChildObj()
    {
        $test = new Test();
        $res = serialize($test);

        $this->assertEquals($test->obj->hello(), unserialize($res)->obj->hello());
    }
}

class Test
{
    public $obj;

    public function __construct()
    {
        $this->obj = new Child();
    }
}

class Child
{
    public function hello()
    {
        return 'hello world';
    }
}