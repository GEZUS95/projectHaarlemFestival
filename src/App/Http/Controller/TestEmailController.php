<?php

namespace App\Http\Controller;

use Exception;
use Matrix\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

class TestEmailController extends BaseController
{

    /**
     * @throws Exception
     */
    public function index(Request $request): Response
    {
        return $this->render("partials.tests.test_email", []);
    }

    public function sendEmail($recipient)
    {
        $transport = Transport::fromDsn('smtp://localhost');
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from('info@haarlemfestival.com')
            ->to($recipient)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Haarlem Festival Mail!')
            ->text('Lets go!');

        $mailer->send($email);
    }
}
