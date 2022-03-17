<?php


namespace Matrix\Exception;

use Symfony\Component\Routing\Exception\ExceptionInterface;
use Throwable;

/**
 * Throw this if the data is not validated correctly
 */
class DataIsNotCorrectlyValidated extends \RuntimeException implements ExceptionInterface {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        //@TODO Make a nicer data validator! prob! with a json response and read
        //@TODO out the data so that the we can make an error class that can handle "errors and display them"

        parent::__construct($message, $code, $previous);
    }
}