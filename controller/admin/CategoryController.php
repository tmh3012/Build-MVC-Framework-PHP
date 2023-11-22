<?php

namespace app\controller\admin;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\View;
use app\models\Category;

class CategoryController extends ProductController
{
    public function __construct()
    {
        parent::__construct();
        $this->breadcrumbs[] = [
            'label' => 'Category',
            'url' => Application::renderRoute('admin-cate-index'),
        ];
        $this->pageTitle('Category');

    }

    public function category(Request $request)
    {

        $category = new Category;
        if ($request->isPost()) {
            $validated = $request->validate([
                'name' => ['required'],
                'description' => ['required'],
                'slug' => [
                    'required',
                    ['unique', 'class' => Category::class]
                ],
            ]);
            if ($validated) {
                echo "<pre>";
                var_dump('true');
                echo "</pre>";
                die();
            }
//            echo "<pre>";
//            var_dump($validated);
//            echo "</pre>";
//            die();
//            $category->loadData($request->getBody());
//
//            if ($category->validate()) {
//                echo 'true';
//                die();
//            }
        }
        return $this->View('Admin.Product_Management.category', [
            'model' => $category,
        ]);
    }
}