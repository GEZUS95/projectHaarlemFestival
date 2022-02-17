<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TestEmailController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        return $this->render("partials.tests.test_email", []);
    }

    public function sendEmail(MailerInterface $mailer, $recipient)
    {
        $email = (new Email())
            ->from('info@haarlemfestival.com')
            ->to($recipient)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Test Successfully!')
            ->text('Yow!');

        $mailer->send($email);
    }
}
