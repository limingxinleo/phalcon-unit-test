<?php

namespace App\Jobs;

use App\Utils\Redis;
use Xin\Swoole\Queue\JobInterface;

class TestJob implements JobInterface
{
    public function handle()
    {
        $logger = di('logger')->getLogger('test');
        $logger->info(date('Y-m-d H:i:s'));

        Redis::incr('php:unit:incr');
    }
}
