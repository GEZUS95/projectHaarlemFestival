<?php

namespace App\Rules;

use App\Model\Performer;
use Illuminate\Contracts\Validation\Rule;

class PerformerExistValidation implements Rule
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
        if(isset($value)) // Cause special guest can be null!
            return true;

        return Performer::query()->find($value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The performer doesnt exist';
    }
}
