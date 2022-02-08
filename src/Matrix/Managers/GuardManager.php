<?php

namespace Matrix\Managers;

use Matrix\Exception\NotLoggedInException;
use Matrix\Exception\UnauthorizedAccessException;

class GuardManager
{
    public static function guard($permission): bool
    {
        if(!AuthManager::isLoggedIn()) {
            throw new NotLoggedInException();
        }

        $user = AuthManager::getCurrentUser();
        if(!in_array($permission, json_decode($user->role->permissions))){
            throw new UnauthorizedAccessException();
        }

        //Passes
        return true;
    }
}

