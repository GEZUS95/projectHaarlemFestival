<?php

namespace App\Rules;

use App\Model\Program;
use Illuminate\Contracts\Validation\Rule;

class ProgramExistValidation implements Rule
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
        return Program::query()->find($value)->exists();
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
