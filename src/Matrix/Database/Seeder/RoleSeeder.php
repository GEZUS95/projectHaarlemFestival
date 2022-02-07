<?php

namespace Matrix\Database\Seeder;

use App\Model\Role;

class RoleSeeder
{
    public function seed()
    {
        Role::create([
            'permissions' => '[]',
        ]);

        Role::create([
            'permissions' => "['Admin']",
        ]);
    }
}
