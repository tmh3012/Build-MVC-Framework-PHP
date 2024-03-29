<?php

use app\controller\admin\AdminController;
use app\controller\admin\CategoryController;
use app\controller\admin\ProductController;
use app\controller\AuthController;
use app\controller\SiteController;
use app\controller\UserController;
use app\core\Application;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$config = [
    'userClass' => \app\models\User::class,
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new app\core\Application(dirname(__DIR__), $config);

$app->router->get('/', [SiteController::class, 'home']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handlerContact']);
$app->router->get('/login', [AuthController::class, 'login'], 'login');
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);
$app->router->get('/logout', [AuthController::class, 'logout']);
$app->router->get('/user/profile', [UserController::class, 'profile']);
$app->router->get('/user/profile/{id:\d+}', [UserController::class, 'profileWithId']);


$app->router->get('/admin/', [AdminController::class, 'viewTest'], 'admin');
$app->router->get('/admin/product-management', [ProductController::class, 'index'], 'admin-product-index');
$app->router->get('/admin/product-category', [CategoryController::class, 'category'], 'admin-cate-index');
$app->router->post('/admin/product-category', [CategoryController::class, 'category']);

$app->run();