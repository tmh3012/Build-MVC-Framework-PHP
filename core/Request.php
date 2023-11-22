<?php

namespace app\core;

class Request
{
    private array $routeParams = [];

    public function __construct()
    {
        if ($_GET) {
            foreach ($_GET as $key => $value) {
                Application::$app->session->setFlash($key, $value);
            }
        }
        if ($_POST) {
            foreach ($_POST as $key => $value) {
                Application::$app->session->setFlash($key, $value);
            }
        }
    }

    public function getHomePath()
    {
        if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $url = 'https://' . $_SERVER['HTTP_HOST'];
        } else {
            $url = 'http://' . $_SERVER['HTTP_HOST'];
        }
        return $url;
    }

    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet(): bool
    {
        return $this->method() === 'get';
    }

    public function isPost(): bool
    {
        return $this->method() === 'post';
    }

    public function get($key)
    {
        if ($this->isGet())
        {
            return $_GET[$key];
        }
        if ($this->isPost())
        {
            return $_POST[$key];
        }
        return null;
    }

    public function getBody()
    {
        $body = [];
        if ($this->method() == 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->method() == 'post') {

            if (isset($_FILES)) {
                foreach ($_FILES as $key => $file) {
                    $body[$key] = $file;
                }
            }

            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

    public function getUrl()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');
        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function setRouteParams($params)
    {
        $this->routeParams = $params;
        return $this;
    }

    public function getRouteParams()
    {
        return $this->routeParams;
    }

    public function getRouteParam($param, $default = null)
    {
        return $this->routeParams[$param] ?? $default;
    }

    public function validate($rules)
    {
        $validation = new Validation($this->getBody(), $rules);
        return $validation->validate();
    }
}