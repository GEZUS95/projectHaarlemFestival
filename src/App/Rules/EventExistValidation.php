<?php

namespace App\Rules;

use App\Model\Event;
use Illuminate\Contracts\Validation\Rule;

class EventExistValidation implements Rule
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
        return Event::query()->find($value)->exists();
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