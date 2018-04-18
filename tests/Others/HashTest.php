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
}
