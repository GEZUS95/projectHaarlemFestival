<?php

namespace Matrix\Managers;

use App\Model\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class AuthManager
{
    /**
     * @param $email
     * @param $password
     * @return bool
     */
    public static function login($email, $password): bool
    {
        $user = User::query()
            ->where('email','=',$email)
            ->first();

        if (!self::verifyPassword($password, $user->password)) {
            return false;
        }

        SessionManager::getSessionManager()->set("user_email", $user->email);
        return true;
    }

    /**
     * @param $password
     * @param $hash
     * @return bool
     */
    private static function verifyPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function logout(){
        SessionManager::getSessionManager()->remove("user_email");
    }

    /**
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        $email = SessionManager::getSessionManager()->get("user_email");

        if($email == null){
            self::logout();
            return false;
        }

        return true;
    }

    /**
     * @return Builder|Model|object|null
     */
    public static function getCurrentUser()
    {
        $email = SessionManager::getSessionManager()->get("user_email");
        $user = User::query()->where("email", "=", $email)->first();

        if($user == null)
            return null;

        //hide password in case it some1 how ends up in the front end :P
        if(self::isLoggedIn()) {
            $user->password = null;
            return $user;
        }

        return null;
    }
}
