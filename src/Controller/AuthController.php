<?php

namespace Auth\src\Controller;

use Auth\src\Http\Router;
use Auth\src\Model\AuthModel;

class AuthController
{
    public function index(Router $router): void
    {
        $router->render('register', null);
    }

    public function save(Router $router): void
    {
        if (isset($_POST)) {
            $user = new AuthModel($_POST);
            $errors = $user->create();
            if (empty($errors)) {
                $data = AuthModel::all();
                $router->render('admin', ['data' => $data]);
            } else {
                $router->render('register', ['errors' => $errors]);
            }
        }
    }

    public function show(Router $router): void
    {
        $users = AuthModel::all();
        $router->render('admin', ['data' => $users]);
    }
}
