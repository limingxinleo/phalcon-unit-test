<?php
// +----------------------------------------------------------------------
// | Ins2.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Instance;

namespace App\Biz\Instance;

use App\Core\Support\InstanceBase;

class Ins2 extends InstanceBase
{
    public function str()
    {
        return 'Ins2';
    }

    public function instance()
    {
        $key = get_called_class();
        return static::$_instances[$key];
    }
}
