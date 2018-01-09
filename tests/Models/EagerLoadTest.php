<?php
// +----------------------------------------------------------------------
// | ModelTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Models;

use App\Common\Model\SqlCount;
use App\Models\User;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class EagerLoadTest extends UnitTestCase
{
    public function testEagerLoadTraitCase()
    {
        SqlCount::getInstance()->flush();

        $users = User::with('book', [
            'order' => 'id DESC',
            'limit' => 2,
        ]);

        foreach ($users as $user) {
            $arr = $user->book;
        }

        $this->assertEquals(2, SqlCount::getInstance()->count);

    }
}
