<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Matrix\Managers\EmailManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EmailController extends BaseController
{
    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        return $this->render("partials.tests.test_email", []);
    }

    public function sendEmail()
    {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return;
        }
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        unset($_POST);
        EmailManager::sendEmail($email, $subject, $message);
        return header("Location: ".$_SERVER[''] .'/emailtest');
    }

    public function sendCSSEmail()
    {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return;
        }
        $subject = $_POST["subject"];
        $message = $_POST["message"];
        unset($_POST);
        EmailManager::sendEmail($email, $subject, $message);

        return header("Location: ".$_SERVER[''] .'/emailtest');
    }
}
