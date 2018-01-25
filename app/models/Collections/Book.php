<?php
// +----------------------------------------------------------------------
// | Book.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Models\Collections;

class Book extends Mongo
{
    public $name;

    public $publis_time;

    public $author_id;

    public function getSource()
    {
        return 'book';
    }
}