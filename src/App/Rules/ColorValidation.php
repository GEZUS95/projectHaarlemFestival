<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ColorValidation implements Rule
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
        return preg_match("/^#([0-9a-f]{3}){1,2}$/i", $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The event doesnt exist';
    }
}