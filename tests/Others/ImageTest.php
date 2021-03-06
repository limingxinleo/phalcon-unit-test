<?php
// +----------------------------------------------------------------------
// | PregTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use Tests\UnitTestCase;

/**
 * Class UnitTest
 */
class ImageTest extends UnitTestCase
{
    public function testGetimagesize()
    {
        $image = ROOT_PATH . '/public/static/images/logo.png';
        $image = getimagesize($image);
        $this->assertEquals(3, $image[2]);
    }
}
