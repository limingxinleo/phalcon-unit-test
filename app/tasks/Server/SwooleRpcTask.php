<?php

namespace App\Tasks\Server;

use App\Biz\Server\Test;
use App\Tasks\Task;
use Xin\Phalcon\Cli\Traits\Input;
use Xin\Swoole\Rpc\Server;

class SwooleRpcTask extends Task
{
    use Input;

    public function mainAction()
    {
        $server = new Server();
        $pid = di('config')->application->pidsDir;
        $daemonize = $this->option('daemonize', false);

        $server->setHandler('test', Test::getInstance());
        $server->serve('0.0.0.0', '11521', [
            'pid_file' => $pid . 'swoole_rpc.pid',
            'daemonize' => $daemonize,
            'max_request' => 500,
        ]);
    }

}

