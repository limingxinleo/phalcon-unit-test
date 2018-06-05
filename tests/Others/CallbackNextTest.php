<?php
// +----------------------------------------------------------------------
// | AndOrTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Biz\Objects\CallNext;
use Tests\UnitTestCase;

class CallbackNextTest extends UnitTestCase
{
    public function testCallbackNext()
    {
        $callback = function ($request) {
            return $request['count'];
        };

        for ($i = 0; $i < 10; $i++) {
            $cls = new CallNext();
            $callback = function ($request) use ($cls, $callback) {
                return $cls->handle($request, $callback);
            };
        }

        $request = ['count' => 0];
        $res = $callback($request);

        $this->assertEquals(10, $res);
    }
}
