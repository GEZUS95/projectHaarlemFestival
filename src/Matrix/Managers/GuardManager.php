<?php

namespace Matrix\Managers;

use App\Model\Permissions;
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

        //user is admin so we can let him pass anyway
        if(in_array(Permissions::__ADMIN__, json_decode($user->role->permissions))){
           return true;
        }

        //Check if the user has the normal permission
        if(!in_array($permission, json_decode($user->role->permissions))){
            throw new UnauthorizedAccessException();
        }

        //user has the right perms let her/him pass
        return true;
    }
}

