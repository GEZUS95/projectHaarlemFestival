<?php

namespace Matrix\Managers;

use App\Model\User;

class AuthManager
{
    protected static ?User $user = null;

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
        self::$user = $user;
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
        $user_email = SessionManager::getSessionManager()->has("user_email");

        if(self::$user != $user_email){
            self::logout();
            return false;
        }

        return true;
    }

    /**
     * @return User|null
     */
    public static function getCurrentUser(): ?User
    {
        if(self::$user == null)
            return null;

        //hide password in case it some1 how ends up in the front end :P
        if(self::isLoggedIn()) {
            self::$user->password = null;
            return self::$user;
        }

        return null;
    }
}