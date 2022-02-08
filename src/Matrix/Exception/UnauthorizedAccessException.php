<?php


namespace Matrix\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;

/**
 * Throw this error is there is no access to certain page
 * thrown from the GuardManager::class
 * caught in the Framework::class
 */
class UnauthorizedAccessException extends \RuntimeException implements ExceptionInterface {
}