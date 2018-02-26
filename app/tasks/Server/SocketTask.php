<?php

namespace App\Tasks\Server;

use App\Core\Cli\Task\Socket;
use Xin\Cli\Color;
use Xin\Phalcon\Cli\Traits\Input;
use swoole_server;
use swoole_process;

class SocketTask extends Socket
{
    use Input;

    public function onConstruct()
    {
        $this->port = 11520;
        $this->host = '127.0.0.1';
    }

    protected function events()
    {
        return [
            'receive' => [$this, 'receive'],
            'WorkerStart' => [$this, 'workerStart'],
        ];
    }

    protected function beforeServerStart(swoole_server $server)
    {
        parent::beforeServerStart($server);
        $config = $this->getConfig();
        if ($this->option('daemonize')) {
            $config['daemonize'] = true;
        }
        // 重置参数
        $server->set($config);

        // 工作进程
        $worker = new swoole_process(function (swoole_process $worker) use ($server) {
            swoole_timer_tick(1000, function () use ($worker) {
                echo 'tick:' . time() . ':' . $worker->pid . PHP_EOL;
            });
            $server->tick(1000, function () {
                echo 'tick:' . time() . PHP_EOL;
            });
        });

        $server->addProcess($worker);
    }

    public function workerStart(swoole_server $server, $workerId)
    {
        // 查看不能被平滑重启的文件
        // $files = get_included_files();
        // dump($files);
    }

    public function receive(swoole_server $server, $fd, $reactor_id, $data)
    {
        echo $data . PHP_EOL;
        $server->send($fd, 'receive:' . $data);
    }

    protected function getConfig()
    {
        // @see https://wiki.swoole.com/wiki/page/274.html Swoole文档Socket配置选项
        $pidsDir = di('config')->application->pidsDir;
        return [
            'pid_file' => $pidsDir . 'socket.pid',
            'user' => 'nginx',
            'group' => 'nginx',
            'daemonize' => false,
            // 'worker_num' => 8, // cpu核数1-4倍比较合理 不写则为cpu核数
            'max_request' => 500, // 每个worker进程最大处理请求次数
        ];
    }
}

