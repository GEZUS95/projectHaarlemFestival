<?php

namespace Matrix\Database\Seeder;

use App\Model\Permissions;
use App\Model\Role;

class RoleSeeder
{
    public function seed()
    {
        Role::create([
            'name' => "admin",
            'permissions' => json_encode(
                array(
                    Permissions::__ADMIN__,
                )
            ),
        ]);
    }
}
