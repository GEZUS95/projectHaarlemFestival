<?php


namespace Matrix\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;
use Throwable;

/**
 * Throw this if the user is not logged in
 * thrown from the GuardManager::class && AuthManager::class
 * caught in the Framework::class
 */
class DataIsNotCorrectlyValidated extends \RuntimeException implements ExceptionInterface {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        //Make a nicer data validator! prob!

        parent::__construct($message, $code, $previous);
    }
}