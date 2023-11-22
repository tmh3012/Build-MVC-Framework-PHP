<?php

namespace app\controller;

use app\core\Controller;
use app\core\middleware\AuthMiddleware;
use app\core\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function profile()
    {
        return $this->View('frontEnd.profile');
    }
    public function profileWithId(Request $request)
    {
        echo "<pre>";
        var_dump($request->getRouteParam('id'));
        echo "</pre>";
        return $this->View('frontEnd.profile');
    }

}