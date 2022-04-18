<?php

namespace App\Rules;

use App\Model\Permissions;
use Illuminate\Contracts\Validation\Rule;
use Matrix\Managers\SessionManager;

class TokenValidation implements Rule
{
    private string $token_type;

    public function __construct($token_type)
    {
        $this->token_type = $token_type;
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
        $session = SessionManager::getSessionManager();
        return true;
//        return $value == $session->get($this->token_type);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The token is invalid';
    }
}