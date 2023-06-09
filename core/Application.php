<?php

namespace app\core;

use app\models\User;

class Application
{

    public View $view;
    public Database $db;
    public string $userClass;
    public ?DbModel $user;
    public Router $router;
    public Request $request;
    public Session $session;
    public Response $response;
    public Controller $controller;
    public static Application $app;
    public static string $ROOT_DIR;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->view = new View();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->userClass = $config['userClass'];
        $primaryKeyValue = $this->session->get('user');
        if ($primaryKeyValue) {
            $primaryKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primaryKey => $primaryKeyValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Throwable $e) {
            echo $this->view->renderView('_error', [
                'errorMessage' => $e->getMessage(),
            ]);
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }

    public static function assets($fileName): string
    {
        $path = self::$ROOT_DIR . "/public/assets/$fileName";
        if (file_exists($path)) {
            $path = str_replace(self::$ROOT_DIR.'/public', self::homeUrl(), $path);
        } else {
            $path = '';
        }
        return $path;
    }

    public static function homeUrl(): string
    {
        return self::$app->request->getHomePath();
    }

    public static function renderRoute(string $routeName): string
    {
        return self::$app->router->routeName->getUrl($routeName);
    }


    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryKeyValue = $user->{$primaryKey};
            $this->session->set('user', $primaryKeyValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest(): bool
    {
        return !self::$app->user;
    }

    public static function isAdmin(): bool
    {
        return self::$app->user->role === 1;
    }
}