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

    public function register(Router $router): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $user = new AuthModel($_POST);
        $errors = $user->create();
        if (empty($errors)) {
            $_SESSION['profile'] = [
                'email' => $user->getEmail(),
                'name' => $user->getFullName(),
                'role' => $user->getRole(),
                'created_at' => $user->getCreatedAt(),
            ];
            $router->redirect('/profile');
        } else {
            $router->render('register', ['errors' => $errors]);
        }
    }

    public function login(Router $router): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $user = new AuthModel($_POST);
        $errors = $user->authenticate();
        if (empty($errors)) {
            $_SESSION['profile'] = [
                'email' => $user->getEmail(),
                'name' => $user->getFullName(),
                'role' => $user->getRole(),
                'created_at' => $user->getCreatedAt(),
            ];
            $router->redirect('/profile');
            exit;
        } else {
            $router->render('login', ['errors' => $errors]);
            exit;
        }
    }

    public function profile(Router $router): void
    {
        $router->render('profile', ['data' => $_SESSION['profile'] ?? null]);
    }

    public function show(Router $router): void
    {
        $users = AuthModel::all();
        $router->render('admin', ['data' => $users]);
    }
}
