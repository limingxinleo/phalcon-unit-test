<?php
// +----------------------------------------------------------------------
// | AndOrTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Biz\Calculater\Calculater;
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

    public function testCalculater()
    {
        $params = [
            1 => 1,
            2 => 3,
            10 => 22,
            11 => 123
        ];

        $string = '+ (1) (+ (1) (2))';
        $result = Calculater::getInstance()->calculater($string, $params);
        $this->assertEquals(5, $result);

        $string = '+ (1) (+ (1) 2)';
        $result = Calculater::getInstance()->calculater($string, $params);
        $this->assertEquals(4, $result);

        $string = '+ (1) (+ 1 (11))';
        $result = Calculater::getInstance()->calculater($string, $params);
        $this->assertEquals(125, $result);
    }
}
