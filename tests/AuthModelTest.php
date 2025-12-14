<?php

namespace Auth\src\tests;

use PDO;
use Auth\src\Model\AuthModel;
use PHPUnit\Framework\TestCase;

final class AuthModelTest extends TestCase
{
    private PDO $stubPDO;

    protected function setUp(): void
    {
        parent::setUp();

        $this->stubPDO = $this->createStub(PDO::class);
    }

    public function testConstructorStoresUserData(): void
    {
        $userData = [
            'email' => 'test@example.com',
            'full_name' => 'John Smith',
            'password' => '12345678',
        ];

        $user = new AuthModel($userData, $this->stubPDO);

        $this->assertSame('test@example.com', $user->getEmail());
        $this->assertSame('12345678', $user->getPassword());
        $this->assertSame('John Smith', $user->getFullName());
    }

    public function testValidateFailsWithInvalidEmailFormat(): void
    {
        $userData = [
            'email' => 'not an email',
            'full_name' => 'John Smith',
            'password' => '12345678',
        ];

        $user = new AuthModel($userData, $this->stubPDO);

        $this->assertFalse($user->validate());
        $this->assertContains('Invalid email format', $user->getErrors());
    }
}
