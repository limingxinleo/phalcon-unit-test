<?php
// +----------------------------------------------------------------------
// | CookiesTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Test;

use Tests\HttpTestCase;

/**
 * Class UnitTest
 */
class CookiesTest extends HttpTestCase
{
    public function testRequestWithCookieCase()
    {
        $response = $this->get('/api/index/cookie');
        $cookies = $response->getHeader('Set-Cookie');
        $cookieArray = [];
        foreach ($cookies as $cookie) {
            preg_match('/(.*);/U', $cookie, $res);
            if (isset($res[1])) {
                list($key, $value) = explode('=', $res[1]);
                $cookieArray[$key] = $value;
            }
        }
        $cookieStr = '';
        foreach ($cookieArray as $key => $value) {
            $cookieStr .= $key . '=' . $value . ';';
        }

        $data = json_decode($response->getBody()->getContents());

        $this->assertTrue($data->success);
        $response = $this->post('/api/index/cookie');
        $data = json_decode($response->getBody()->getContents());
        $this->assertFalse($data->success);
        $this->assertEquals(1001, $data->errorCode);

        $response = $this->post('/api/index/cookie', [
            'headers' => [
                'Cookie' => $cookieStr
            ],
        ]);
        $data = json_decode($response->getBody()->getContents());
        $this->assertTrue($data->success);
    }

    public function testRequestWithCookieFileCase()
    {
        $cookieFile = tempnam(ROOT_PATH . '/storage/cache/', 'cookie_');
        $url = env('PHPUNIT_URL') . '/api/index/cookie';

        // 请求接口拿到Cookie
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
        curl_exec($ch);
        curl_close($ch);

        //带上cookie文件，访问需要访问的页面
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
        $contents = curl_exec($ch);
        curl_close($ch);

        //清理cookie文件
        unlink($cookieFile);
        $data = json_decode($contents);
        $this->assertTrue($data->success);
    }
}
