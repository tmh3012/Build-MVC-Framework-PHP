<?php 
namespace app\core;

Class Application {

    public View $view;
    public Database $db;
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
    }


    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->view->renderView('_error', [
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
}