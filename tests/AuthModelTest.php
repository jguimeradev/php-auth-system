<?php

namespace Auth\src\tests;

use PDO;
use PDOStatement;
use Auth\src\Model\AuthModel;
use PHPUnit\Framework\TestCase;

final class AuthModelTest extends TestCase
{
    //TODO: #4 Validation tests
    private PDO $stubPDO;

    protected function setUp(): void
    {
        parent::setUp();

        $this->stubPDO = $this->createStub(PDO::class);
    }

    /**
     * Test 1: Constructor stores user data correctly 
     * 
     * **/
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

    /**
     * Test 2: Invalid Email Format 
     * 
     */
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

    /**
     * Test 3: Insert users
     */
}
