<?php
// +----------------------------------------------------------------------
// | BuilderTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Test\Models;

use App\Models\User;
use Tests\UnitTestCase;
use App\Models\Book;

/**
 * Class UnitTest
 */
class BuilderTest extends UnitTestCase
{
    public function testBuilderCase()
    {
        $manager = di('modelsManager');
        $user = User::class;

        $query = $manager->createQuery("SELECT * FROM {$user} ORDER BY id DESC LIMIT 1");
        $users = $query->execute();
        $this->assertTrue($users[0]->id > 0);

        $users = $manager->createBuilder()
            ->from($user)
            ->where('id=1')
            ->getQuery()
            ->execute();

        $this->assertTrue($users[0]->id > 0);
        $this->assertTrue(count($users) === 1);
    }

    public function testLeftJoinModel()
    {
        $user = User::class;
        $book = Book::class;

        $list = User::query()->columns("[$user].*,[$book].*")
            ->leftJoin($book, "[$book].[uid] = [$user].[id]")
            ->andWhere("[$user].[id] = :id:")
            ->bind(['id' => 1], true)
            ->execute();

        foreach ($list as $item) {
            /** @var User $userModel */
            $userModel = $item->{lcfirst($user)};
            $this->assertEquals(1, $userModel->id);
            $this->assertEquals('limx', $userModel->name);

            /** @var Book $bookModel */
            $bookModel = $item->{lcfirst($book)};
            $this->assertEquals(1, $bookModel->uid);
        }
    }
}
