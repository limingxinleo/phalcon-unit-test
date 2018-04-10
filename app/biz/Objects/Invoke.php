<?php
// +----------------------------------------------------------------------
// | Invoke.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Objects;

use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use Xin\Traits\Common\InstanceTrait;

class Invoke
{
    use InstanceTrait;

    public function __invoke()
    {
        $params = func_get_args();
        if (!isset($params[0])) {
            throw new BizException(ErrorCode::$ENUM_INVOKE_ERROR);
        }

        $method = $params[0];
        array_shift($params);

        return call_user_func_array([$this, $method], $params);
    }

    public function test($x)
    {
        return $x;
    }

    public function add($a, $b)
    {
        return $a + $b;
    }
}
