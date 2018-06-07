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

class FunctionTest extends UnitTestCase
{
    public function testFunctionExec()
    {
        $res = exec(ROOT_PATH . '/echo.sh');

        $this->assertEquals('Hi, limx', $res);

        $res = exec(ROOT_PATH . '/echo2.sh');

        $this->assertEquals('Hi, Agnes', $res);
    }
}
