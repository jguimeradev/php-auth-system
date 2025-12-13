<?php

require '../src/Config/bootstrap.php';

use Auth\src\Http\Router;

$router = new Router;
$router->get('/', fn() => $router->render('index', null));
$router->dispatch();
