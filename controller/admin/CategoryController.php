<?php

namespace app\controller\admin;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\View;

class CategoryController extends ProductController
{
//    public function index(Request $request)
//    {
//        return $this->View('Admin.Product_Management.category');
//    }

    public function __construct()
    {
        parent::__construct();
        $this->breadcrumbs[] = [
            'label' => 'Category',
            'url' => Application::renderRoute('admin-cate-index'),
        ];
        $this->pageTitle('Category');

    }

    public function category()
    {
        return $this->View('Admin.Product_Management.category');
    }

    public function store(Request $request)
    {
        echo "<pre>";
        var_dump($request->getBody());
        echo "</pre>";
        die();
    }
}