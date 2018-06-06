<?php
// +----------------------------------------------------------------------
// | Enums.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Tests\Others;

use App\Biz\Objects\Alias;
use App\Biz\Objects\Invoke;
use App\Common\Enums\ErrorCode;
use Symfony\Component\Finder\Finder;
use Tests\UnitTestCase;
use Alias2;

/**
 * Class UnitTest
 */
class ClassTest extends UnitTestCase
{
    public function testClassAlias()
    {
        class_alias(Alias::class, 'Alias2');
        $o1 = Alias::getInstance();
        $o2 = Alias2::getInstance();

        $this->assertEquals($o1, $o2);
        $this->assertEquals($o1->say(), $o2->say());
        $this->assertTrue($o1 instanceof Alias);
        $this->assertTrue($o1 instanceof Alias2);
        $this->assertTrue($o2 instanceof Alias);
        $this->assertTrue($o2 instanceof Alias2);
    }

    public function testClassAliasCache()
    {
        $dir = ROOT_PATH . '/libs/aliyun-openapi-php-sdk';
        require_once $dir . '/aliyun-php-sdk-core/Config.php';

        $btime = microtime(true);
        $finder = Finder::create()->in($dir);

        $targetClass = [];
        $iterator = $finder->files()->getIterator();
        foreach ($iterator as $file) {
            $classArr = explode('/', $file->getRelativePathname());
            if (isset($classArr[2]) && $classArr[2] == 'Request') {
                unset($classArr[0]);
                $target = rtrim(implode('\\', $classArr), '.php');
                unset($classArr[3]);
                $alias = rtrim(implode('\\', $classArr), '.php');
                if (class_exists($target)) {
                    class_alias($target, $alias);
                    $targetClass[$alias] = $target;
                }
            }
        }

        $etime = microtime(true);
        $time1 = $etime - $btime;

        $request = new \Ecs\Request\V20140526\DescribeAvailableResourceRequest();
        $this->assertEquals('POST', $request->getMethod());

        $request = new \Ecs\Request\DescribeAvailableResourceRequest();
        $this->assertEquals('POST', $request->getMethod());

        /** @var \Phalcon\Cache\BackendInterface $cache */
        $cache = di('cache');
        $cache->save('aliyun:openapi', $targetClass);

        $btime = microtime(true);
        $arr = $cache->get('aliyun:openapi');
        foreach ($arr as $alias => $class) {
            if (class_exists($class)) {
                class_alias($class, $alias . '2');
            }
        }

        $etime = microtime(true);

        $time2 = $etime - $btime;

        $request = new \Ecs\Request\DescribeAvailableResourceRequest2();
        $this->assertEquals('POST', $request->getMethod());

        $this->assertTrue($time2 < $time1);
    }

    public function testClassExist()
    {
        $this->assertTrue(class_exists(Alias::class));
        $this->assertFalse(class_exists('Alias3'));
        class_alias(Alias::class, 'Alias3');
        $this->assertTrue(class_exists('Alias3'));
    }

    public function testInvoke()
    {
        $cls = new Invoke();
        $this->assertEquals(11, $cls('test', 11));
        $this->assertEquals([1, 2, 3], $cls('test', [1, 2, 3]));
        $this->assertEquals('x', $cls('test', 'x'));

        $this->assertEquals(3, $cls('add', 1, 2));
        $this->assertEquals(7, $cls('add', 5, 2));

        try {
            $cls();
        } catch (\Exception $ex) {
            $this->assertEquals(ErrorCode::$ENUM_INVOKE_ERROR, $ex->getCode());
        }
    }
}
