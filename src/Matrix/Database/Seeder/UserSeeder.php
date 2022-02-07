<?php

namespace Matrix\Database\Seeder;

use App\Model\User;

class UserSeeder
{
    public function seed()
    {
        User::create([
            'email' => 'admin@example.com',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'role_id' => 1,
        ]);
    }
}
