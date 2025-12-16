<?php

namespace Auth\src\Model;

use PDO;
use Auth\src\Database\DBConnection;


class AuthModel
{
    private array $errors = [];
    private PDO $pdo;

    private string $table = "users";

    public function __construct(public array $args = [], ?PDO $pdo = null)
    {
        $this->pdo = $pdo ?? self::connectDB();
    }

    public static function connectDB(): PDO
    {
        return DBConnection::getConnection();
    }

    public static function all(): array
    {
        $pdo = self::connectDB();
        $res = $pdo->prepare('SELECT * FROM users');
        $res->execute();
        $data = $res->fetchAll(PDO::FETCH_OBJ);
        return $data;
    }

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

        if (empty($this->args['name'])) {
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

        try {
            $this->pdo = self::connectDB();
            $stmt = $this->pdo->prepare(
                "INSERT INTO {$this->table} (name, email, password_hash, role, created_at)
            VALUES (?,?,?,?,?)"
            );

            $stmt->execute([
                $this->args['name'],
                $this->args['email'],
                password_hash($this->args['password'], PASSWORD_BCRYPT),
                $this->args['role'] ?? 'User',
                date('Y-m-d H:i:s'),
            ]);

            return [];
        } catch (\PDOException $e) {
            array_push($this->errors, "Database error: {$e->getMessage()}");
        }

        return $this->errors;
    }



    public function authenticate(): array
    {

        $this->pdo = self::connectDB();
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$this->args['email']]);
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        if (empty($data)) {
            array_push($this->errors, "Email or password incorrect");
            return $this->errors;
        }

        if (!password_verify($this->args['password'], $data[0]->password_hash)) {
            array_push($this->errors, "Email or password incorrect");
            return $this->errors;
        }

        return $this->errors;
    }
    public function getErrors()
    {
        return $this->errors;
    }

    //for testing purposes
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
        return $this->args['name'] ?? '';
    }

    public function getRole(): string
    {
        return $this->args['role'] ?? 'User';
    }

    public function getCreatedAt(): string
    {
        return date('Y-m-d H:i:s');
    }

    public function read(): void {}

    public function update(): void {}

    public function delete(): void {}
}
