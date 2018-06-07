<?php

namespace App\Tasks\Test;

use App\Tasks\Task;
use Phalcon\Cache\BackendInterface;

class TestTask extends Task
{
    public function mainAction()
    {
        echo 'Hi, Agnes';
    }

    public function addCacheAction()
    {
        /** @var BackendInterface $cache */
        $cache = di('cache');
        $cache->save('another:task:save:cache', 'Hi, limx');
    }
}
