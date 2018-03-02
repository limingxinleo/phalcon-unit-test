<?php
// +----------------------------------------------------------------------
// | ConfigTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Services;

use App\Core\System;
use Tests\HttpTestCase;

/**
 * Class UnitTest
 */
class MiddlewareTest extends HttpTestCase
{
    public function testMiddlewareCase()
    {
        $res = $this->post('/api/index/middleware', [
            'form_params' => [
                'success' => true
            ]
        ]);
        $data = json_decode($res->getBody()->getContents(), true);
        $this->assertTrue($data['success']);

        $res = $this->post('/api/index/middleware', [
            'form_params' => [
                'success' => false
            ]
        ]);
        $data = json_decode($res->getBody()->getContents(), true);
        $this->assertFalse($data['success']);

        $res = $this->post('/api/index/middleware');
        $data = json_decode($res->getBody()->getContents(), true);
        $this->assertFalse($data['success']);
    }
}
