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
        $data = json_decode($response->getBody()->getContents());
        $this->assertEquals(System::getInstance()->version(), $data->version);
        $this->assertEquals("You're now flying with Phalcon. Great things are about to happen!", $data->message);
    }

    public function testRouterCase()
    {
        $response = $this->post('/api/index');
        $data = json_decode($response->getBody()->getContents());
        $this->assertEquals('I am IndexController@index', $data->message);
    }

    public function testRequestFileCase()
    {
        $response = $this->post('/api/index/upload');
        $data = json_decode($response->getBody()->getContents());

        $this->assertNull($data->key);
        $this->assertNull($data->name);

        $path = ROOT_PATH . '/public/static/images/logo.png';
        $response = $this->post('/api/index/upload', [
            'multipart' => [
                [
                    'name' => 'image',
                    'contents' => fopen($path, 'r')
                ]
            ],
        ]);
        $data = json_decode($response->getBody()->getContents());
        $this->assertEquals('image', $data->key);
        $this->assertEquals('logo.png', $data->name);
    }
}
