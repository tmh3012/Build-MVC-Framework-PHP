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
        // get view content and view main
        $layoutContent = $this->renderViewMaster();
        $viewContent = $this->renderViewContent($view, $data);

        // handler push resource (css, js) from view content to main layout
        while (strpos($viewContent, "{{push(") !== false) {
            $pushStart = strpos($viewContent, "{{push(");
            $pushEnd = strpos($viewContent, ")}}");

            //get flag name of push block
            $stackType = substr($viewContent, $pushStart + strlen("{{push("), $pushEnd - ($pushStart + strlen("{{push(")));
            // get content to transfer
            $subEnd = strpos($viewContent, "{{endpush($stackType)}}") + strlen("{{endpush($stackType)}}");
            $result = ltrim(substr($viewContent, $pushStart, $subEnd - $pushStart), "{{push($stackType)}}");
            $result = rtrim($result, "{{endpush($stackType)}}");

            // push main content of resource to the specified position
            $viewContent = substr_replace($viewContent, '', $pushStart, $subEnd - $pushStart);
            $layoutContent = str_replace("{{stack($stackType)}}", $result, $layoutContent);
        }
        // remove {{stack(flag)}} if view content don't push resource
        while (preg_match("/\{\{stack\([^)]*\)\}\}/", $layoutContent)){
            $layoutContent = preg_replace("/\{\{stack\([^)]*\)\}\}/", '', $layoutContent);
        }

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