<?php

namespace Auth\src\Controller;

use Auth\src\Http\Router;
use Auth\src\Model\AuthModel;

class AuthController
{
    public function index(Router $router): void
    {
        $router->render('signup', null);
    }

    public function register(Router $router): void
    {
        if (isset($_POST)) {
            $user = new AuthModel($_POST);
        }
    }
}
