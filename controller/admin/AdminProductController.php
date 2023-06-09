<?php

namespace app\controller\admin;

use app\core\Application;
use app\core\Controller;
use app\core\View;

class AdminProductController extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        $this->breadcrumbs[] = [
            'label' => 'Product',
            'url' => Application::renderRoute('admin-product-index'),
        ];
    }
    public function category()
    {
        $this->pageTitle('Category');
        $this->breadcrumbs[] = [
            'label' => 'Category',
            'url' => Application::renderRoute('admin-cate-index'),
        ];
        return $this->View('Admin.Product_Management.category');
    }

    public function index()
    {
        return $this->View('Admin.Product_Management.product_index');
    }
}