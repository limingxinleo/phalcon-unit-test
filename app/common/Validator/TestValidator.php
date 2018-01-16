<?php
// +----------------------------------------------------------------------
// | TestValidator.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Validator;

use App\Core\Validation\Validator;
use Phalcon\Validation\Validator\PresenceOf;

class TestValidator extends Validator
{
    public function initialize()
    {
        $this->add(
            [
                'id',
                'name'
            ],
            new PresenceOf([
                'message' => 'the :field is required'
            ])
        );
    }
}
