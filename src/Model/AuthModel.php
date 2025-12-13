<?php

namespace Auth\src\Model;

use PDO;
use Auth\src\Database\DBConnection;

class AuthModel
{
    private array $errors = [];
    private PDO $pdo;
    public function __construct(public array $args, ?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? DBConnection::getConnection();
    }


    public static function all() {}

    public static function findByEmail() {}


    public function validate(): bool
    {
        if (empty($this->args['email'])) {
            array_push($this->errors, "Email is required");
        } elseif (!filter_var($this->args['email'], FILTER_VALIDATE_EMAIL)) {
            array_push($this->errors, "Invalid email format");
        }

        if (empty($this->args['full_name'])) {
            array_push($this->errors, "Name is required");
        }

        if (empty($this->args['password'])) {
            array_push($this->errors, "Password is empty");
        } elseif (strlen($this->args['password']) < 8) {
            array_push($this->errors, "Password must be at least 8 characters");
        }

        return empty($this->errors);
    }


    public function create(): array
    {
        if (!$this->validate()) {
            return $this->errors;
        }

        return $this->errors;
    }
    public function read(): void {}

    public function update(): void {}

    public function delete(): void {}
}
