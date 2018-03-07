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
class FileTest extends UnitTestCase
{
    public function testReadFileToArray()
    {
        $file = ROOT_PATH . '/public/static/file/user.txt';
        $handler = fopen($file, 'r');

        $result = [];
        while (!feof($handler)) {
            $line = fgets($handler);
            $line = str_replace(PHP_EOL, '', $line);
            $item = explode(' ', $line);
            $result[] = $item;
        }

        $this->assertEquals(
            [
                ['limx', 'Agnes'],
                ['wsh']
            ],
            $result
        );
    }
}