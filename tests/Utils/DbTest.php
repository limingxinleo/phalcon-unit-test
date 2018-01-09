<?php
// +----------------------------------------------------------------------
// | DBTest.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace Test\Utils;

use App\Utils\DB;
use App\Utils\DB1;
use Tests\UnitTestCase;
use PDO;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Events\Manager as EventsManager;
use App\Core\Event\DbListener;

class DbTest extends UnitTestCase
{
    public $table = 'test';

    public function testBaseCase()
    {
        $sql = "SELECT * FROM `user`;";
        $res = DB::query($sql);
        $this->assertTrue(count($res) > 0);
    }

    public function testDb1Case()
    {
        // 增加db1 服务
        $di = di();
        $config = di('config');

        $di->setShared('db1', function () use ($config) {
            $db = new DbAdapter(
                [
                    'host' => $config->database->host,
                    'username' => $config->database->username,
                    'password' => $config->database->password,
                    'dbname' => $config->database->dbname,
                    'charset' => $config->database->charset,
                    'options' => [
                        PDO::ATTR_CASE => PDO::CASE_NATURAL,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
                        PDO::ATTR_STRINGIFY_FETCHES => false,
                        PDO::ATTR_EMULATE_PREPARES => false,
                    ],
                ]
            );
            if ($config->log->db) {
                $eventsManager = new EventsManager();
                // 创建一个数据库侦听
                $dbListener = new DbListener();
                // 侦听全部数据库事件
                $eventsManager->attach(
                    "db",
                    $dbListener
                );
                $db->setEventsManager($eventsManager);
            }
            return $db;
        });


        $sql = "SELECT * FROM `user`;";
        $res = DB1::query($sql);
        $this->assertTrue(count($res) > 0);
    }

    public function testInsert()
    {
        $sql = "INSERT INTO `user` (`name`,`role_id`) VALUES (?,?)";
        $res = DB::execute($sql, [uniqid(), 1]);
        $this->assertTrue($res);
    }

    public function testQuery()
    {
        $sql = "SELECT * FROM `user` WHERE `name` = ? LIMIT 1;";
        $res = DB::query($sql, ['limx']);
        $this->assertTrue(count($res) > 0);
        $this->assertTrue(is_array($res));
    }

    public function testFetch()
    {
        $sql = "SELECT * FROM `user` WHERE `name` = ? LIMIT 1;";
        $res = DB::fetch($sql, ['limx']);
        $this->assertTrue(is_array($res));

        $res = DB::fetch($sql, ['limx'], PDO::FETCH_OBJ);
        $this->assertTrue(is_object($res));
    }

    public function testExecute()
    {
        $sql = "INSERT INTO `user` (`name`,`role_id`) VALUES (?,?)";
        $res = DB::execute($sql, [uniqid(), 25]);
        $this->assertTrue($res);

        $res = DB::execute($sql, [uniqid(), 25], true);
        $this->assertEquals(1, $res);

        $sql = "UPDATE `user` SET name=? WHERE role_id =? LIMIT 1";
        $res = DB::execute($sql, [uniqid(), 25], true);
        $this->assertTrue(is_numeric($res));
    }

    public function testTableExist()
    {
        $this->assertTrue(DB::tableExists('user'));
        $this->assertFalse(DB::tableExists('sss'));
    }

    public function testDelete()
    {
        $sql = "DELETE FROM `user` WHERE id > ?";
        $this->assertTrue(DB::execute($sql, [3]));
    }
}
