<?php
// +----------------------------------------------------------------------
// | Test.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz;

use App\Models\User;
use Xin\Traits\Common\InstanceTrait;

class Test
{
    use InstanceTrait;

    public function yieldString()
    {
        yield 'This is a keyword for yield.';
    }

    public function yieldArray()
    {
        yield 'limx';
        yield 'Agnes';
    }

    public function yieldObject()
    {
        $obj = new \stdClass();
        $obj->id = 1;
        $obj->name = 'limx';

        yield $obj;
    }

    public function yieldModel()
    {
        yield User::findFirst(1);
    }

    public function yieldModels()
    {
        yield User::findFirst(1);
        yield User::findFirst(2);
    }

    public function retManyModels()
    {
        $res = User::find();
        $result = [];
        foreach ($res as $v) {
            $result[] = $v;
        }
        return $result;
    }

    public function yieldManyModels()
    {
        $res = User::find();
        foreach ($res as $v) {
            yield $v;
        }
    }
}