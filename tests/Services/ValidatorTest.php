<?php
// +----------------------------------------------------------------------
// | ValidatorTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Services;

use App\Common\Validator\TestValidator;
use App\Core\System;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class ValidatorTest extends UnitTestCase
{
    public function testValidationPassCase()
    {
        $data = [
            'id' => 1,
            'name' => 'limx'
        ];
        $validator = new TestValidator();
        if ($validator->validate($data)->valid()) {
            $this->assertTrue(false, "Validation Failed");
        } else {
            $this->assertEquals(1, $validator->getValue('id'));
            $this->assertEquals('limx', $validator->getValue('name'));
        }
    }

    public function testValidationFaildCase()
    {
        $data = [
            'id' => 1,
        ];
        $validator = new TestValidator();
        if ($validator->validate($data)->valid()) {
            $this->assertEquals('the name is required', $validator->getErrorMessage());
        } else {
            $this->assertTrue(false, "Validation Failed");
        }
    }
}
