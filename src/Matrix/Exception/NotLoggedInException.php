<?php


namespace Matrix\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;

/**
 * Throw this if the user is not logged in
 * thrown from the GuardManager::class && AuthManager::class
 * caught in the Framework::class
 */
class NotLoggedInException extends \RuntimeException implements ExceptionInterface {
}