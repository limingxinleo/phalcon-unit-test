<?php
// +----------------------------------------------------------------------
// | User.php [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2017 limingxinleo All rights reserved.
// +----------------------------------------------------------------------
// | Author: limx <715557344@qq.com> <https://github.com/limingxinleo>
// +----------------------------------------------------------------------
namespace App\Models\Repository;

use Xin\Traits\Common\InstanceTrait;
use App\Models\User as UserModel;

class User
{
    use InstanceTrait;

    public function add($name, $roleId)
    {
        $user = new UserModel();
        $user->name = $name;
        $user->role_id = $roleId;

        if ($user->save()) {
            return $user->id;
        }
        return false;
    }

    public function getCacheKey($id)
    {
        return sprintf('user:model:%d', $id);
    }

    public function first($id)
    {
        $cacheKey = $this->getCacheKey($id);
        return UserModel::findFirst([
            'conditions' => 'id = ?0',
            'bind' => [$id],
            'cache' => ['lifetime' => 3600, 'key' => $cacheKey],
        ]);
    }

    public function delete(UserModel $user)
    {
        /** @var \Phalcon\Cache\BackendInterface $cache */
        $cache = di('cache');
        $key = $this->getCacheKey($user->id);
        if (!$cache->exists($key)) {
            return $user->delete();
        }
        if ($cache->delete($key)) {
            return $user->delete();
        }

        return false;
    }

    public function save(UserModel $user)
    {
        /** @var \Phalcon\Cache\BackendInterface $cache */
        $cache = di('cache');
        $key = $this->getCacheKey($user->id);
        if (!$cache->exists($key)) {
            return $user->save();
        }
        if (!$cache->delete($key)) {
            throw new \Exception(sprintf("模型[%s][%d]缓存删除失败", UserModel::class, $user->id));
        }

        return $user->save();
    }
}