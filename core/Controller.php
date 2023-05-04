<?php

namespace app\core;

class Controller
{
    public string $layout = "master";

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
}