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
use App\Models\Book;
use App\Models\User;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class EagerLoadTest extends UnitTestCase
{
    public function testEagerLoadTraitCase()
    {
        /** @var \Phalcon\Mvc\Model\MetaDataInterface $meta */
        $meta = di('modelsMetadata');
        $meta->readMetaData(new User());
        $meta->readMetaData(new Book());

        SqlCount::getInstance()->flush();

        $users = User::with('book', [
            'limit' => 2,
        ]);

        foreach ($users as $user) {
            $arr = $user->book;
        }

        $this->assertEquals(2, SqlCount::getInstance()->count);
    }

    public function testType()
    {
        $users = User::find([
            'limit' => 2,
        ]);

        $this->assertTrue(is_object($users));
        $this->assertEquals('Phalcon\Mvc\Model\Resultset\Simple', get_class($users));

        $users = User::with('book', [
            'limit' => 2,
        ]);

        $this->assertTrue(is_array($users));
    }
}
