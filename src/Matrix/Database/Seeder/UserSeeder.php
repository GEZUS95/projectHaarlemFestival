<?php

namespace Matrix\Database\Seeder;

use App\Model\User;
use Faker\Factory;

class UserSeeder
{
    public function seed()
    {
        $faker = Factory::create();

        User::create([
            'name' => $faker->name,
            'email' => 'admin@example.com',
            'password' => password_hash('password', PASSWORD_BCRYPT),
            'role_id' => 1,
        ]);
    }
}
