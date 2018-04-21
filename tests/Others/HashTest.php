<?php
// +----------------------------------------------------------------------
// | AndOrTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use Tests\UnitTestCase;

class HashTest extends UnitTestCase
{
    public $password = '123456';

    public function testPasswordHash()
    {
        $pwd1 = password_hash($this->password, PASSWORD_BCRYPT);
        $pwd2 = password_hash($this->password, PASSWORD_BCRYPT);

        $this->assertNotEquals($pwd1, $pwd2);
        $this->assertTrue(password_verify($this->password, $pwd1));
        $this->assertTrue(password_verify($this->password, $pwd2));

        $pwd3 = password_hash($this->password, PASSWORD_DEFAULT);
        $this->assertTrue(password_verify($this->password, $pwd3));
    }

    public function testSha256()
    {
        $pwd1 = hash("sha256", $this->password);
        $pwd2 = hash("sha256", $this->password);
        $this->assertEquals($pwd1, $pwd2);

        $pwd3 = hash('md5', $this->password);
        $pwd4 = md5($this->password);

        $this->assertEquals($pwd3, $pwd4);
    }

    public function testMcryptAndOpenssl()
    {
        $iv = "1234567890123412";
        $key = 'd48d03c3322006ec772a7eefd8532c88';
        $data = '111111';

        if (version_compare(PHP_VERSION, '7.2', '<')) {
            error_reporting(E_ALL & ~E_DEPRECATED);
            $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
            $pass = base64_encode($encrypted);
            $data2 = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($pass), MCRYPT_MODE_CBC, $iv);
            $this->assertEquals($data, rtrim($data2, "\0"));
            error_reporting(E_ALL);
        }

        $encrypted = openssl_encrypt($data, "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $pass2 = base64_encode($encrypted);
        $data2 = openssl_decrypt(base64_decode($pass2), "AES-128-CBC", $key, OPENSSL_RAW_DATA, $iv);
        $this->assertEquals($data, $data2);

    }
}
