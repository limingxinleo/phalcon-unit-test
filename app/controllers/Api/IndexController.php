<?php

namespace App\Controllers\Api;

use App\Common\Enums\ErrorCode;
use App\Common\Exceptions\BizException;
use App\Controllers\Controller;
use App\Models\User;
use App\Utils\Redis;
use App\Utils\Response;
use Phalcon\Http\Request\File;
use Phalcon\Text;

class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->response->setJsonContent([
            'message' => 'I am IndexController@index'
        ]);
    }

    public function uploadAction()
    {
        /** @var File $file */
        $file = $this->request->getFile('image');
        if ($file) {
            return $this->response->setJsonContent([
                'key' => $file->getKey(),
                'name' => $file->getName()
            ]);
        }

        return $this->response->setJsonContent([
            'key' => null,
            'name' => null
        ]);
    }

    /**
     * @desc
     * @author limx
     * @Middleware('test')
     * @return \Phalcon\Http\Response|\Phalcon\Http\ResponseInterface
     */
    public function middlewareAction()
    {
        return $this->response->setJsonContent([
            'success' => true,
        ]);
    }

    /**
     * @desc   测试Cookies设置
     * @author limx
     */
    public function cookieAction()
    {
        if ($this->request->isPost()) {
            // 验证Cookie
            $cookie = Redis::get('php:unit:token');
            if ($cookie != $this->cookies->get('AUTH_TOKEN')->getValue()) {
                throw new BizException(ErrorCode::$ENUM_AUTH_TOKEN_ERROR);
            }
            return Response::success([
                'token' => $this->cookies->get('AUTH_TOKEN')->getValue()
            ]);
        }

        // 设置Cookie
        $token = Text::random();
        Redis::set('php:unit:token', $token);
        $this->cookies->set('AUTH_TOKEN', $token);

        return Response::success([
            'token' => $token
        ]);
    }

    public function sessionAction()
    {
        if ($this->request->isPost()) {
            // 验证Cookie
            $user = $this->session->get('AUTH_USER');
            if (!$user) {
                throw new BizException(ErrorCode::$ENUM_SESSION_ERROR);
            }

            return Response::success([
                'user' => $user
            ]);
        }

        // 设置Cookie
        $user = User::findFirst(1)->toArray();
        $user['uniqid'] = uniqid();
        $this->session->set('AUTH_USER', $user);

        return Response::success([
            'user' => $user
        ]);
    }
}
