<?php

namespace App\Rules;

use App\Model\Program;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class ItemIsBetweenProgramTimes implements Rule
{

    private $program;

    public function __construct($programId)
    {
        $this->program = Program::find($programId);
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        if(!$this->program)
            return false;

        return Carbon::parse($value)
            ->isBetween(
                Carbon::parse($this->program->start_time),
                Carbon::parse($this->program->end_time)
            );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The time is outside the program times';
    }
}
