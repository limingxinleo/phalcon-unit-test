<?php

namespace MyApp\Controllers\Test;

use limx\tools\LRedis;
use limx\tools\wx\OAuth;
use limx\tools\MyRedis;

class IndexController extends ControllerBase
{
    public function initAction()
    {
        dump($this->settings);
    }

    public function pAction($key = 'p1', $p = 'p2')
    {
        dump($key);
        dump($p);
    }

    public function show500Action()
    {
        $code = '500';
        $msg = '出错了';
        return dispatch_error($code, $msg);
//        $dispatcher = di('dispatcher');
//        $dispatcher->forward(
//            [
//                'namespace' => 'MyApp\Controllers',
//                'controller' => 'error',
//                'action' => 'index',
//                'params' => [$code, $msg],
//            ]
//        );
    }

    public function indexAction()
    {
        return $this->view->render('test', 'index');
    }

    public function redisTestAction()
    {
        /** composer require limingxinleo/limx-redis */
        $config = [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'auth' => env('REDIS_AUTH'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_INDEX', 0),
        ];
        $redis = MyRedis::getInstance($config);
        dump($redis->keys('test:*'));
        $redis->set('test:1', 1);
        $redis->iNcr('test:2', 1);
        $redis->set('test:3', 1);

        $redis = LRedis::getInstance($config);
        $arr = $redis->keys('*');
        dump($arr);
        $redis->select(1);
        $arr = $redis->keys('*');
        dump($arr);
    }

    public function lredisAction()
    {
        /** composer require limingxinleo/limx-redis */
        $config = [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'auth' => env('REDIS_AUTH'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_INDEX', 0),
        ];
        $redis1 = LRedis::getInstance($config);
        $redis2 = LRedis::getInstance($config);
        dump($redis1);
        dump($redis2);
        $config['database'] = 1;
        $redis3 = LRedis::getInstance($config);
        dump($redis2);

        dump($redis1->keys('*'));
        dump($redis2->keys('*'));
        dump($redis3->keys('*'));
    }

    public function myredisAction()
    {
        $config = [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'auth' => env('REDIS_AUTH'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_INDEX', 0),
        ];
        $redis1 = MyRedis::getInstance($config);
        $redis2 = MyRedis::getInstance($config);
        dump($redis1);
        dump($redis2);
        $config['database'] = 1;
        $redis3 = MyRedis::getInstance($config);
        dump($redis2);

        dump($redis1->keys('*'));
        dump($redis2->keys('*'));
        dump($redis3->keys('*'));
    }

    public function saveAction()
    {
        $user = User::findFirst(1);
        $this->view->setVars([
            'name' => $user->name
        ]);
        return $this->view->render('test/index', 'save');
    }

    public function postSaveAction()
    {
        $user = User::findFirst(1);
        $user->name = $this->request->get('name');
        if ($user->save() === true) {
            return success();
        }
        return error();
    }

    public function voltAction()
    {
        $this->view->app = 'limx';
        $this->view->setVars([
            'app2' => 'limx2'
        ]);

        return $this->view->render('test/index', 'volt');
    }

    public function mrAction()
    {

        return $this->response->redirect('test/index/model');
    }


    public function cacheAction()
    {
        $config = di('config')->cache;
        dump($config);

        dump(di('cache')->get('test_1'));
        di('cache')->save('test_1', ['text' => 'Cache Test', 'time' => time()]);

        dump(di('cache')->queryKeys());
    }

    public function urlAction()
    {
        $url = $this->url->get('index/getParams', ['key1' => 1111, 'key2' => 222]);
        dump($url);

        $url = url('index/getParams', ['key1' => 1111, 'key2' => 222]);
        dump($url);

        $url = $this->request->getURI();
        dump($url);
        dump($this->request->getScheme() . ':' . $this->request->getHttpHost() . $url);

    }

    public function requestAction()
    {
        $request = $this->request;

        dump($request->get());                          //默认获取所有的请求参数返回的是array效果和获取$_REQUEST相同
        dump($request->get('wen'));                     //获取摸个特定请求参数key的valuer和$_REQUEST['key']相同
        dump($request->getQuery('url', null, 'url'));   //获取get请求参数,第二个参数为过滤类型,第三个参数为默认值
        dump($request->getMethod());                    //获取请求的类型如果是post请求会返回"POST"
        dump($request->isAjax());                       //判断请求是否为Ajax请求
        dump($request->isPost());                       //判断是否是Post请求类似的有(isGet,isPut,isPatch,isHead,isDelete,isOptions等)
        dump($request->getHeaders());                   //获取所有的Header,返回结果为数组
        dump($request->getHeader('Content-Type'));      //获取Header中的的莫一个指定key的指
        dump($request->getURI());                       //获取请求的URL比如phalcon.w-blog.cn/phalcon/Request获取的/phalcon/Request
        dump($request->getHttpHost());                  //获取请求服务器的host比如phalcon.w-blog.cn/phalcon/Request获取的phalcon.w-blog.cn
        dump($request->getServerAddress());             //获取当前服务器的IP地址
        dump($request->getRawBody());                   //获取Raw请求json字符
        dump($request->getJsonRawBody());               //获取Raw请求json字符并且转换成数组对象
        dump($request->getScheme());                    //获取请求是http请求还是https请求
        dump($request->getServer('REMOTE_ADDR'));       //等同于$_SERVER['REMOTE_ADDR']
    }

    public function getParamsAction()
    {
        $params = $this->request->get();
        dump($params);
    }

    /**
     * [wxAction desc]
     * @desc 微信获取授权OPENID的测试
     * @composer require limingxinleo/wx-api
     * @author limx
     */
    public function wxAction()
    {
        $code = $this->request->get('code');
        $appid = env('APPID');
        $appsec = env('APPSECRET');
        $api = new OAuth($appid, $appsec);
        $api->code = $code;// 微信官方回调回来后 会携带code
        $url = env('APP_URL') . '/test/index/wx';//当前的URL
        $api->setRedirectUrl($url);
        $res = $api->getUserInfo();
        dump($res);
    }

    public function configAction()
    {
        dump(di('config')->env);
        dump($this->app['project-name']);
        dump(di('app'));
    }

    public function envAction()
    {
        dump(env('TEST'));
    }

    public function sessionAction()
    {
        $this->session->set("user-name", "Michael");
        $name = $this->session->get("user-name");
        dump($name);
        dump(session('user-name'));
    }
}

