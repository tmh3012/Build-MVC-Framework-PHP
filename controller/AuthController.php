<?php

namespace app\controller;

use app\core\Application;
use app\core\Controller;
use app\core\middleware\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\enum\UserTypeEnum;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{


    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response)
    {
        $this->pageTitle('Login');
        $this->setLayout("auth");
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                if (Application::isAdmin()) {
                    $response->redirect('/admin/product-category');
                    exit;
                }

                $response->redirect('/');
            }
        }

        return $this->View('auth.login', [
            'model' => $loginForm,
        ]);
    }

    public function register(Request $request, Response $response)
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

    public function logout()
    {
        Application::$app->logout();
        Application::$app->response->redirect('/login');
        exit;
    }
}