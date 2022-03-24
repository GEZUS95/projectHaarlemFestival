<?php

namespace App\Rules;

use App\Model\Event;
use App\Model\Permissions;
use App\Model\User;
use Illuminate\Contracts\Validation\Rule;

class UserEmailAlreadyExistValidation implements Rule
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
        return !User::query()
            ->where('email','=',$value)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The email does exist';
    }
}