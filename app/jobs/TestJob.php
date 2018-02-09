<?php

namespace App\Jobs;

use App\Jobs\Contract\JobInterface;

class TestJob implements JobInterface
{
    public function handle()
    {
        $logger = di('logger')->getLogger('test');
        $logger->info(date('Y-m-d H:i:s'));
    }
}

