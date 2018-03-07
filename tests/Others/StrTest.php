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
}