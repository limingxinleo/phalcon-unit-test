<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use Phalcon\Http\Request\File;

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
}
