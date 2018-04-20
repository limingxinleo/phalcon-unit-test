<?php
// +----------------------------------------------------------------------
// | JsonArray.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Objects\Tree;

class JsonArray
{
    public function __construct($items)
    {
        foreach ($items as $item) {
            $key = 'id_' . $item['id'];
            $this->$key = new JsonItem($item['id'], $item['pid']);
        }
    }

    public function toTree()
    {
        foreach ($this as $item) {
            if ($item->pid > 0) {
                $key = 'id_' . $item->pid;
                $this->$key->children[] = $item;
            }
        }

        return $this;
    }

    public function toArray()
    {
        $result = [];
        foreach ($this as $item) {
            if ($item->pid == 0) {
                $result[] = $item->toArray();
            }
        }
        return $result;
    }


    public function __get($name)
    {
        $key = 'id_' . $name;
        return $key;
    }
}