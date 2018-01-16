<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;

class IndexController extends Controller
{

    public function indexAction()
    {
        return $this->response->setJsonContent([
            'message' => 'I am IndexController@index'
        ]);
    }

}

