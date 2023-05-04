<?php

namespace app\core;

class View
{
    /**
     * @return string
     */
    public string $title = '';

    public function renderView($view, $data = [])
    {
        $layoutContent = $this->renderViewMaster();
        $viewContent = $this->renderViewContent($view, $data);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function renderViewMaster()
    {
        $layout = Application::$app->controller->layout;
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/$layout.php";
        return ob_get_clean();
    }

    protected function renderViewContent($view, $data)
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/" . str_replace('.', '/', $view) . ".php";
        return ob_get_clean();
    }
}