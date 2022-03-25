<?php

namespace Matrix\Managers;

use App\Model\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Matrix\Exception\NotLoggedInException;

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
            throw new NotLoggedInException();
        }

        return true;
    }

    public static function boolLoggedIn(): bool
    {
        $email = SessionManager::getSessionManager()->get("user_email");

        return !$email == null;
    }

    /**
     * @return Builder|Model|object|null
     */
    public static function getCurrentUser()
    {
        $email = SessionManager::getSessionManager()->get("user_email");
        $user = User::query()->where("email", "=", $email)->first();

        if($user == null)
            throw new NotLoggedInException();

        //@TODO check if self::isLoggedIn() is dupe code remove if it is!
        if(self::isLoggedIn()) {
            $user->password = null;
            return $user;
        }

        return null;
    }
}
