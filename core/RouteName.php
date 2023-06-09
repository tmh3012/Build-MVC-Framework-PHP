<?php

namespace app\core;

class RouteName
{
    public array $routeMap = [];

    public function defineRouteName($name, $path = null)
    {
        if (!array_key_exists($name, $this->routeMap)) {
            $this->routeMap[$name] = $path;
        }
    }

    public function getRouteName($name)
    {
        return $this->routeMap[$name];
    }

    public function getUrl($routeName): string
    {
        return Application::homeUrl() . $this->getRouteName($routeName);
    }
}