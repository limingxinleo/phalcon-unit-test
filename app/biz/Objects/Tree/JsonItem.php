<?php
// +----------------------------------------------------------------------
// | JsonItem.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Biz\Objects\Tree;

class JsonItem
{
    public $id;

    public $pid;

    public $children = [];

    public function __construct($id, $pid)
    {
        $this->id = $id;
        $this->pid = $pid;
    }

    public function toArray()
    {
        $result = [];
        $result['id'] = $this->id;
        $result['pid'] = $this->pid;
        $result['children'] = [];
        foreach ($this->children as $child) {
            $result['children'][] = $child->toArray();
        }
        return $result;
    }
}
