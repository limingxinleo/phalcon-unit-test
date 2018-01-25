<?php
// +----------------------------------------------------------------------
// | Collections.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Models;

use App\Models\Collections\Book;
use App\Models\Collections\User;
use Phalcon\Text;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class CollectionsTest extends UnitTestCase
{
    public function testBaseCase()
    {
        if (di('config')->mongo->isCollection) {
            $id = Text::random(Text::RANDOM_ALNUM, 16);
            $user = new User();
            $user->id = $id;
            $user->name = '测试';
            $user->age = rand(1, 18);
            $user->save();

            $users = User::find([
                'conditions' => ['id' => $id]
            ]);

            $this->assertTrue(count($users) > 0);
            $this->assertTrue($user->delete());
        }
    }

    public function testSaveCase()
    {
        if (di('config')->mongo->isCollection) {
            $id = Text::random(Text::RANDOM_ALNUM, 16);

            $user = new User();
            $user->id = $id;
            $user->name = '测试';
            $user->age = rand(1, 18);
            $this->assertTrue($user->save());

            $book = new Book();
            $book->name = '测试书籍';
            $book->publis_time = date('Y-m-d');
            $book->author_id = $user->getId();
            $this->assertTrue($book->save());

            $user2 = User::findById($book->author_id);

            $this->assertEquals($user->toArray(), $user2->toArray());
        }
    }
}
