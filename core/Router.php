<?php

namespace app\core;


class Router
{

    public Request $request;
    public Response $response;
    protected array $routeMap = [];
    public string $homeUrl;
    public RouteName $routeName;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        $this->homeUrl = $request->getHomePath();
        $this->routeName = new RouteName();
    }

    public function get($path, $callback, $name = null)
    {
        if (!empty($name)) {
            $this->routeName->defineRouteName($name, $path);
        }
        $this->routeMap['get'][$path] = $callback;
    }

    public  function post($path, $callback, $name = null)
    {
        if (!empty($name)) {
            $this->routeName->defineRouteName($name, $path);
        }
        $this->routeMap['post'][$path] = $callback;
    }

    public function getRouteMap($method): array
    {
        return $this->routeMap[$method] ?? [];
    }

    public function resolve()
    {

        $path = $this->request->getUrl();
        $method = $this->request->method();
        $callback = $this->routeMap[$method][$path] ?? false;
        if (!$callback) {
            $callback = $this->getCallback();
            if (!$callback) {
                $this->response->setStatusCode(404);
                return "404 not found";
            }
        }
        if (is_string($callback)) {
            return Application::$app->view->renderView($callback);
        }

        if (is_array($callback)) {
            $controller = new $callback[0];
            $controller->actions = $callback[1];
            Application::$app->controller = $controller;
            $middlewares = $controller->getMiddlewares();
            foreach ($middlewares as $middleware) {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }
        return call_user_func($callback, $this->request, $this->response);
    }

    public function getCallback()
    {
        $method = $this->request->method();
        $url = $this->request->getUrl();
        $url = trim($url, '/');
        $routes = $this->getRouteMap($method);

        $routeParams = false;
        foreach ($routes as $route => $callback) {
            // Trim slashes
            $route = trim($route, '/');
            $routeNames = [];
            if (!$route) {
                continue;
            }
            // Find all route names from route and save in $routeNames
            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }
            // Convert route name into regex pattern
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";
            // Test and match current route against $routeRegex
            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);
                $this->request->setRouteParams($routeParams);
                return $callback;
            }

        }
        return false;
    }
}