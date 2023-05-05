<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        $this->pageTitle('Login');
        $this->setLayout("auth");
        return $this->View('auth.login');
    }

    public function register(Request $request)
    {
        $this->pageTitle('Register');
        $this->setLayout("auth");

        $registerModel = new RegisterModel();

        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() && $registerModel->register()) {
                return 'success';
            }
            return $this->View('auth.register', [
                'model' => $registerModel,
            ]);
        }

        return $this->View('auth.register', [
            'model' => $registerModel,
        ]);
    }
}