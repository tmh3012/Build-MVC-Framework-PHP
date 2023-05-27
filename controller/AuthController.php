<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\enum\UserTypeEnum;
use app\models\User;

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

        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('register_success', 'thank for registering');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->View('auth.register', [
                'model' => $user,
            ]);
        }

        return $this->View('auth.register', [
            'model' => $user,
        ]);
    }
}