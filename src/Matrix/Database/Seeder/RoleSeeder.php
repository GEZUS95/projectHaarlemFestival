<?php

namespace Matrix\Database\Seeder;

use App\Model\Permissions;
use App\Model\Role;

class RoleSeeder
{
    public function seed()
    {
        Role::create([
            'permissions' => json_encode(array()),
        ]);

        Role::create([
            'permissions' => json_encode(
                array(
                    Permissions::__ADMIN__,
                )
            ),
        ]);
    }
}
