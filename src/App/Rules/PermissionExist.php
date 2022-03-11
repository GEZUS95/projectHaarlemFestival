<?php

namespace App\Rules;

use App\Model\Permissions;
use Illuminate\Contracts\Validation\Rule;

class PermissionExist implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        //If the perms are empty aka No permissions in the system we can pass
        if(!isset($value))
            return true;

        //If the perms don't exist in the current permissions then we can't pass!
        $allPerms = Permissions::getAllPermissions();
        foreach (explode(",", $value) as $perm){
            if(!in_array( $perm, $allPerms))
                return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The permission doesnt exist';
    }
}