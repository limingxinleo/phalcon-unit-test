<?php

namespace App\Controllers\Api;

use App\Controllers\Controller;
use App\Utils\Response;

class DetailController extends Controller
{

    public function indexAction()
    {
        $id = $this->dispatcher->getParam('id');
        return Response::success($id);
    }

}

