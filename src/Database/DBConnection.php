<?php

namespace Auth\src\Database;

use PDO;
use RuntimeException;

final class DBConnection
{
    private static ?PDO $pdo = null;

    private function __construct() {}

    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            $dsn = sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $_ENV['DB_HOST'],
                $_ENV['DB_DATABASE'],
                $_ENV['DB_CHARSET'],
            );

            try {
                self::$pdo = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                throw new RuntimeException('Database connection failed', 0, $e);
            }
        }
        return self::$pdo;
    }

    // Optional: for testing
    public static function resetConnection(): void
    {
        self::$pdo = null;
    }
}
