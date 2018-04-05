<?php
// +----------------------------------------------------------------------
// | Quote.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Objects;

use App\Models\User;
use Xin\Traits\Common\InstanceTrait;

class Quote
{
    use InstanceTrait;

    public $values = [];

    public $object;

    public function __construct()
    {
        $this->object = User::findFirst(1);
    }

    public function getValues()
    {
        return $this->values;
    }

    public function &getValuesQuote()
    {
        return $this->values;
    }

    public function getObject()
    {
        return $this->object;
    }
}