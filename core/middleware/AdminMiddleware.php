<?php

namespace app\core\middleware;

use app\core\Application;
use app\core\exception\ForbiddenException;

class AdminMiddleware extends BaseMiddleware
{
    public function execute()
    {
        if (Application::isGuest() ) {
            Application::$app->session->setFlash('auth_error', 'You are not login');
            Application::$app->response->redirect(Application::renderRoute('login'), 403);
            throw new ForbiddenException();
        }
    }
}