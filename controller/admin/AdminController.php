<?php

namespace app\controller\admin;

use app\core\Application;
use app\core\Controller;
use app\core\middleware\AdminMiddleware;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->registerMiddleware(new AdminMiddleware());
        $this->setLayout('admin_master');
        $this->breadcrumbs[] = [
            'label' => 'Admin',
            'url' => Application::renderRoute('admin'),
        ];
    }
}