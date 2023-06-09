<?php

namespace app\controller\admin;

use app\core\Application;
use app\core\Controller;
use app\core\View;

class AdminProductCategoryController extends AdminController
{
    public function index()
    {
        return $this->View('Admin.Product_Management.category');
    }
}