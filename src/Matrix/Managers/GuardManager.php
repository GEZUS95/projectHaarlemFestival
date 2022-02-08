<?php

namespace Matrix\Managers;

use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class GuardManager
{

    public static function guard($permission)
    {
        if(AuthManager::isLoggedIn()) {
            var_dump("is not logged in lel");
        }

        var_dump("ben ingelogt btw");
        $user = AuthManager::getCurrentUser();

        var_dump($user->role->permissions);
        var_dump($user->role->id);
    }

}

