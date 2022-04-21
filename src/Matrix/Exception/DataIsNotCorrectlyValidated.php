<?php


namespace Matrix\Exception;

use Illuminate\Support\Collection;
use Matrix\Managers\SessionManager;
use Symfony\Component\Routing\Exception\ExceptionInterface;
use Throwable;

/**
 * Throw this if the data is not validated correctly
 */
class DataIsNotCorrectlyValidated extends \RuntimeException implements ExceptionInterface {

    private $errors;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        $this->errors = $message;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return bool
     */
    public function getErrors(): bool
    {
        $validationFile = dirname(__DIR__, 2) . "/lang/en/validation.php";
        $validation = include $validationFile;

        $errors = new Collection($this->errors);

        $errorArr = [];
        foreach ($errors as $key => $error) {
            $type = explode(".",$error[0])[1];

            $message = str_replace(":attribute", $key, $validation[$type]);
            array_push($errorArr, $message);
        }

        SessionManager::getSessionManager()->set("validation_errors", $errorArr);

        return true;
    }

}