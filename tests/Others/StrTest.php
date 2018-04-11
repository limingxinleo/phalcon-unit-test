<?php
// +----------------------------------------------------------------------
// | PregTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Common\Enums\ErrorCode;
use App\Common\Helper\Match;
use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class StrTest extends UnitTestCase
{
    public function testStrToUpper()
    {
        $this->assertEquals('AZ', strtoupper('az'));
        $this->assertEquals('哈哈AZ', mb_strtoupper('哈哈az'));
    }

    public function testGetUrlExtension()
    {
        $url = 'http://sina.com.cn/dd/ss/a.php';
        preg_match('/\.(\w+)$/', $url, $match);
        $this->assertEquals('php', $match[1]);

        $arr = parse_url($url);
        $arr = pathinfo($arr['path']);
        $this->assertEquals('php', $arr['extension']);

        $arr = explode('.', $url);
        $this->assertEquals('php', $arr[count($arr) - 1]);
    }

    public function testStripTags()
    {
        $this->assertEquals('alert(1)', strip_tags('<script>alert(1)</script>'));
        $this->assertEquals('alert(1)', strip_tags('<script>alert(1)<script>'));
    }

    public function testStrtrim()
    {
        $str = "\r\n Hello World!\r \n";
        $this->assertEquals('Hello World!', trim($str));

        $str = "\r\n Hello World!\r \n";
        $this->assertEquals("\r\n Hello World!", rtrim($str));

        $str = "\r\n Hello World!\r \n";
        $this->assertEquals("Hello World!\r \n", ltrim($str));
    }

    public function testStrPad()
    {
        $this->assertEquals('00000001', str_pad('1', 8, '0', STR_PAD_LEFT));
        $this->assertEquals('11000000', str_pad('11', 8, '0', STR_PAD_RIGHT));
        $this->assertEquals('00011000', str_pad('11', 8, '0', STR_PAD_BOTH));
    }

    public function testStrRepeat()
    {
        $this->assertEquals('0000', str_repeat('0', 4));
    }

    public function testStrSplit()
    {
        $this->assertEquals([1, 1, 1], str_split('111', 1));
        $this->assertEquals([10, 10, '10'], str_split('101010', 2));
    }

    public function testStrRev()
    {
        $this->assertEquals('hello', strrev('olleh'));
    }

    public function testStrWordwrap()
    {
        $this->assertEquals("I\nam\nlimx", wordwrap('I am limx', 1));
    }
}
