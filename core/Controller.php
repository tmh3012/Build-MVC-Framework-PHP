<?php

namespace app\core;

use app\core\middleware\BaseMiddleware;

class Controller
{
    public string $layout = "master";
    public string $actions = "";
    public array $breadcrumbs;
    /**
     * @var BaseMiddleware[]
    */

    public  array $middleware = [];

    /**
     * @param string
    */
    public function pageTitle($title)
    {
        Application::$app->view->title = $title;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    public function View($view, $data =[])
    {
        return Application::$app->view->renderView($view, $data);
    }

    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middleware[] = $middleware;
    }

    public function getMiddlewares()
    {
        return $this->middleware;
    }
}