<?php

namespace App\Rules;

use App\Model\Role;
use Illuminate\Contracts\Validation\Rule;

class RoleExistValidation implements Rule
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
        return Role::query()->find($value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The role does not exist';
    }
}