<?php

use Auth\src\Database\DBConnection;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

final class DatabaseConnectionTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        // Load .env exactly once
        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
    }

    public function testDatabaseConnectionReturnsPDO(): void
    {
        $pdo = DBConnection::getConnection();

        $this->assertInstanceOf(PDO::class, $pdo);
    }

    public function testConnectionisSingleton(): void
    {
        $pdo1 = DBConnection::getConnection();
        $pdo2 = DBConnection::getConnection();

        $this->assertSame($pdo1, $pdo2);
    }
}
