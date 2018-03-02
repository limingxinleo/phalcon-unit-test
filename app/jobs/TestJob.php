<?php

namespace App\Jobs;

use App\Jobs\Contract\JobInterface;
use App\Utils\Redis;

class TestJob implements JobInterface
{
    public function handle()
    {
        $logger = di('logger')->getLogger('test');
        $logger->info(date('Y-m-d H:i:s'));

        Redis::incr('php:unit:incr');
    }
}
