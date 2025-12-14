<?php

namespace Auth\src\Model;

use PDO;
use Auth\src\Database\DBConnection;

class AuthModel
{
    private array $errors = [];
    private PDO $pdo;

    public function __construct(public array $args = [], ?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? self::connectDB();
    }

    public static function connectDB(): PDO
    {
        return DBConnection::getConnection();
    }

    public static function all() {}

    public static function findByEmail(string $email): array
    {

        $pdo = self::connectDB();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }


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

        $data = self::findByEmail($this->args['email']);

        if (!empty($data)) {
            array_push($this->errors, "User already exists with this email");
            return $this->errors;
        }

        return $this->errors;
    }
    public function read(): void {}

    public function update(): void {}

    public function delete(): void {}


    public function getErrors()
    {
        return $this->errors;
    }

    public function getEmail(): string
    {
        return $this->args['email'] ?? '';
    }

    public function getPassword(): string
    {
        return $this->args['password'] ?? '';
    }

    public function getFullName(): string
    {
        return $this->args['full_name'] ?? '';
    }
}
