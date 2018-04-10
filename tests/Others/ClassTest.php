<?php
// +----------------------------------------------------------------------
// | Enums.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Biz\Objects\Alias;
use Tests\UnitTestCase;
use Alias2;

/**
 * Class UnitTest
 */
class ClassTest extends UnitTestCase
{
    public function testClassAlias()
    {
        class_alias(Alias::class, 'Alias2');
        $o1 = Alias::getInstance();
        $o2 = Alias2::getInstance();

        $this->assertEquals($o1, $o2);
        $this->assertEquals($o1->say(), $o2->say());
        $this->assertTrue($o1 instanceof Alias);
        $this->assertTrue($o1 instanceof Alias2);
        $this->assertTrue($o2 instanceof Alias);
        $this->assertTrue($o2 instanceof Alias2);
    }
}
