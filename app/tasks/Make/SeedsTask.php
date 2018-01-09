<?php

namespace App\Tasks\Make;

use App\Tasks\Task;
use Xin\Cli\Color;
use Xin\Support\File;

class SeedsTask extends Task
{
    public function mainAction()
    {
        $template = $this->getTemplate();
        for ($i = 1; $i < 3; $i++) {
            $dir = 'Seeds';
            $class = 'Model' . $i;
            $source = 'seeds' . $i;
            $result = str_replace('%CLASS%', $class, $template);
            $result = str_replace('%SOURCE%', $source, $result);
            $path = APP_PATH . '/models/' . $dir;
            if (!is_dir($path)) {
                File::getInstance()->makeDirectory($path);
            }
            file_put_contents($path . "/{$class}.php", $result);
        }
        echo Color::success('模型创建成功') . PHP_EOL;
    }

    public function getTemplate()
    {
        return "<?php
namespace App\Models\Seeds;
use App\Models\Seeds as Base;
class %CLASS% extends Base {
    
    public function getSource()
    {
        return '%SOURCE%';
    }
}";
    }
}
