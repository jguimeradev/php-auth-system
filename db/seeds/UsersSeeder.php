<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $now = date('Y-m-d H:i:s');

        $users = [
            [
                'email'             => 'admin@example.com',
                'password_hash'     => password_hash('admin84', PASSWORD_DEFAULT),
                'name'              => 'Admin User',
                'role'              => 'admin',
                'is_active'         => true,
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user1@example.com',
                'password_hash'     => password_hash('password1', PASSWORD_DEFAULT),
                'name'              => 'User One',
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user2@example.com',
                'password_hash'     => password_hash('password2', PASSWORD_DEFAULT),
                'name'              => 'User Two',
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user3@example.com',
                'password_hash'     => password_hash('password3', PASSWORD_DEFAULT),
                'name'              => 'User Three',
                'role'              => 'user',
                'is_active'         => false,
                'email_verified_at' => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user4@example.com',
                'password_hash'     => password_hash('password4', PASSWORD_DEFAULT),
                'name'              => 'User Four',
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user5@example.com',
                'password_hash'     => password_hash('password5', PASSWORD_DEFAULT),
                'name'              => 'User Five',
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user6@example.com',
                'password_hash'     => password_hash('password6', PASSWORD_DEFAULT),
                'name'              => 'User Six',
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user7@example.com',
                'password_hash'     => password_hash('password7', PASSWORD_DEFAULT),
                'name'              => 'User Seven',
                'role'              => 'user',
                'is_active'         => false,
                'email_verified_at' => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user8@example.com',
                'password_hash'     => password_hash('password8', PASSWORD_DEFAULT),
                'name'              => 'User Eight',
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => $now,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
            [
                'email'             => 'user9@example.com',
                'password_hash'     => password_hash('password9', PASSWORD_DEFAULT),
                'name'              => 'User Nine',
                'role'              => 'user',
                'is_active'         => true,
                'email_verified_at' => null,
                'created_at'        => $now,
                'updated_at'        => $now,
            ],
        ];

        $table = $this->table('users');

        /**
         * DEV / TEST ONLY
         * Remove truncate() in shared or production environments.
         */
        $table->truncate();

        $table->insert($users)->saveData();
    }
}
