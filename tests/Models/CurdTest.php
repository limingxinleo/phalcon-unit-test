<?php
// +----------------------------------------------------------------------
// | Curd.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Test\Models;

use App\Models\User;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class CurdTest extends UnitTestCase
{
    public function testAdd()
    {
        $user = new User();
        $user->name = 'test';
        $user->role_id = 1;
        $this->assertTrue($user->save());
    }

    public function testFindFirst()
    {
        $user = User::findFirst([
            'order' => 'id DESC',
        ]);

        $this->assertEquals('test', $user->name);
    }

    public function testFind()
    {
        $users = User::find();

        $this->assertTrue(count($users) > 0);
    }

    public function testEdit()
    {
        $user = User::findFirst([
            'order' => 'id DESC',
        ]);

        $user->name = 'updated';
        $this->assertTrue($user->save());

        $updatedCount = count($user->getUpdatedFields());

        $this->assertTrue($updatedCount >= 1);
        $this->assertTrue($updatedCount <= 2);

        $user = User::findFirst([
            'order' => 'id DESC',
        ]);


        $this->assertEquals('updated', $user->name);
    }

    public function testDelete()
    {
        $user = User::findFirst([
            'order' => 'id DESC',
        ]);

        $this->assertTrue($user->delete());

        $user = User::findFirst([
            'order' => 'id DESC',
        ]);

        $this->assertEquals('wxh', $user->name);
    }

    public function testCount()
    {
        $this->assertTrue(User::count() > 0);
    }

    public function testSaveFailCase()
    {
        $user = new User();
        $user->name = 'limx';
        $this->assertFalse($user->save());

        try {
            $user->role_id = 1;
            $user->save();
        } catch (\Exception $ex) {
            $this->assertEquals(
                "SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'limx' for key 'NAME_UNIQUE'",
                $ex->getMessage()
            );
        }
    }
}