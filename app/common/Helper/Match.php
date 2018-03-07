<?php
// +----------------------------------------------------------------------
// | Match.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Helper;

use Xin\Traits\Common\InstanceTrait;

class Match
{
    use InstanceTrait;

    public function isNumber($number)
    {
        return preg_match('/^-?[1-9A-Fa-f][0-9a-fA-F]*$/', $number);
    }
}
