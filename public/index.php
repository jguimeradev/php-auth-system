<?php

require '../src/Config/bootstrap.php';

use Auth\src\Controller\AuthController;
use Auth\src\Http\Router;

$router = new Router;
$router->get('/', fn() => $router->render('index', null));
$router->get('/register', [new AuthController, 'index']);
$router->post('/register', [new AuthController, 'save']);
$router->get('/profile', [new AuthController, 'profile']);
$router->get('/admin', [new AuthController, 'show']);
$router->dispatch();
