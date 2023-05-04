<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public  function login()
    {
        return $this->View('auth.login');
    }
    public  function register(Request $request)
    {
        if ($request->isPost()) {
            return "handler register";
        }
        $this->pageTitle('Register');
        $this->setLayout("auth");
        return $this->View('auth.register',[
            'title' => 'register page',
        ]);
    }
}