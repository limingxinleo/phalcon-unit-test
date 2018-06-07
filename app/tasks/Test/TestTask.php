<?php

namespace App\Tasks\Test;

use App\Tasks\Task;

class TestTask extends Task
{
    public function mainAction()
    {
        echo 'Hi, Agnes';
    }
}
