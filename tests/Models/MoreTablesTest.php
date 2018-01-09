<?php
// +----------------------------------------------------------------------
// | MoreTablesTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Models;

use App\Models\Seeds;
use App\Models\User;
use Tests\UnitTestCase;

class MoreTablesTest extends UnitTestCase
{
    public function testGetSeeds()
    {
        $user = User::findFirst(1);

        $seeds = Seeds::getInstance($user->id);

        $result = $seeds->find([
            'conditions' => 'uid = ?0',
            'bind' => [$user->id]
        ]);

        $this->assertTrue(count($result) > 0);

        $user = User::findFirst(2);

        $seeds = Seeds::getInstance($user->id);

        $result = $seeds->find([
            'conditions' => 'uid = ?0',
            'bind' => [$user->id]
        ]);

        $this->assertTrue(count($result) > 0);
    }
}