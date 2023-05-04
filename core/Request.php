<?php

namespace app\core;

class Request
{
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

    public function getBody()
    {
        $body = [];
        if ($this->method() == 'get') {
            foreach($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method() == 'post') {
            foreach($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }

}