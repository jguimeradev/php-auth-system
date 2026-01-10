<?php

require '../src/Config/bootstrap.php';

use Auth\src\Controller\AuthController;
use Auth\src\Http\Router;

$router = new Router;
$router->get('/', fn() => $router->render('index', null));

$router->get('/register', [new AuthController, 'index']);
$router->post('/register', [new AuthController, 'register']);

$router->get('/login', fn() => $router->render('login', null));
$router->post('/login', [new AuthController, 'login']);

$router->get('/profile', [new AuthController, 'profile']);

if (isset($_SESSION['profile']) && $_SESSION['profile']['name'] === 'admin') {
    $router->get('/admin', [new AuthController, 'show']);
    $router->get('/admin/edit', [new AuthController, 'edit']);
}

$router->dispatch();
