<?php
// +----------------------------------------------------------------------
// | HttpTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Test;

use App\Core\System;
use Tests\HttpTestCase;

/**
 * Class UnitTest
 */
class HttpTest extends HttpTestCase
{
    public function testJsonResponseCase()
    {
        $response = $this->post('/index/index');
        $data = $response->getContent();
        $data = json_decode($data);
        $this->assertEquals(System::getInstance()->version(), $data->version);
        $this->assertEquals("You're now flying with Phalcon. Great things are about to happen!", $data->message);
    }

    public function testRouterCase()
    {
        $response = $this->post('/api/index');
        $data = $response->getContent();
        $data = json_decode($data);
        $this->assertEquals('I am IndexController@index', $data->message);
    }

    public function testRequestFileCase()
    {
        $response = $this->post('/api/index/upload');
        $data = $response->getContent();
        $data = json_decode($data);

        $this->assertNull($data->key);
        $this->assertNull($data->name);

        $_FILES = [
            'image' => [
                'name' => 'a.png',
                'type' => 'image/png',
                'tmp_name' => 'xxxx/a.png',
                'error' => 0,
                'size' => 100,
            ],
        ];

        $response = $this->post('/api/index/upload');
        $data = $response->getContent();
        $data = json_decode($data);
        
        $this->assertEquals('image', $data->key);
        $this->assertEquals('a.png', $data->name);
    }
}
