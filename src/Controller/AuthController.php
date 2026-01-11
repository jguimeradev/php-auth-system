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
            $user = $user->getLoginData();

            $_SESSION['profile'] = [
                'email' => $user['email'],
                'name' => $user['name'],
                'role' => $user['role'],
                'created_at' => $user['created_at'],
            ];

            if ($_SESSION['profile']['name'] === 'admin') {
                $router->redirect('/admin');
            }

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
        $router->render('admin/admin', ['data' => $users]);
    }

    public function edit(Router $router): void
    {
        //TODO: no me convence la manera de gestionar el id

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $id = $_GET['id'];
            $user = new AuthModel();
            $data = $user->id($id);
            $router->render('admin/edit', ['data' => $data]);
        } else {
            echo "editing user";
        }
    }



    public function delete(Router $router): void {}
}
