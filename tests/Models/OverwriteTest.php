<?php
// +----------------------------------------------------------------------
// | OverwriteTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Models;

use App\Models\Book;
use App\Models\User;
use Tests\UnitTestCase;

class OverwriteTest extends UnitTestCase
{
    public function testModelToArray()
    {
        $book = Book::find(1);
        $this->assertFalse(array_key_exists('test', $book[0]));

        $book = Book::findFirst(1);
        $this->assertFalse(array_key_exists('test', $book));
    }
}