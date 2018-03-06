<?php
// +----------------------------------------------------------------------
// | TestClient.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Common\Clients;

use Xin\Swoole\Rpc\Client\Client;

/**
 * Class TestClient
 * @package App\Common\Clients
 * @method getInteger
 */
class TestClient extends Client
{
    protected $service = 'test';

    protected $host = '127.0.0.1';

    protected $port = 11521;

    const TIMEOUT = 1;
}