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
use App\Biz\Objects\Invoke;
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

    public function testClassExist()
    {
        $this->assertTrue(class_exists(Alias::class));
        $this->assertFalse(class_exists('Alias3'));
        class_alias(Alias::class, 'Alias3');
        $this->assertTrue(class_exists('Alias3'));
    }

    public function testInvoke()
    {
        $cls = new Invoke();
        $this->assertEquals(11, $cls('test', 11));
        $this->assertEquals([1, 2, 3], $cls('test', [1, 2, 3]));
        $this->assertEquals('x', $cls('test', 'x'));

        $this->assertEquals(3, $cls('add', 1, 2));
        $this->assertEquals(7, $cls('add', 5, 2));
    }
}
