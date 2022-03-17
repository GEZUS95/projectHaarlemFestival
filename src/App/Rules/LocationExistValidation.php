<?php

namespace App\Rules;

use App\Model\Location;
use Illuminate\Contracts\Validation\Rule;

class LocationExistValidation implements Rule
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
        return Location::query()->find($value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The location doesnt exist';
    }
}
