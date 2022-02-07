<?php

namespace Matrix\Managers;

use App\Model\User;
use Illuminate\Database\Eloquent\Model;

class AuthManager
{
    protected static ?Model $user = null;

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

    private static function verifyPassword($password, $hash): bool
    {
        return password_verify($password, $hash);
    }

    public static function logout(){
        SessionManager::getSessionManager()->remove("user_email");
    }

    public static function isLoggedIn(): bool
    {
        $user_email = SessionManager::getSessionManager()->has("user_email");

        if(self::$user != $user_email){
            self::logout();
            return false;
        }

        return true;
    }

    public static function getCurrentUser(): ?Model
    {
        if(self::$user == null)
            return null;

        if(self::isLoggedIn())
            return self::$user;

        return null;
    }
}