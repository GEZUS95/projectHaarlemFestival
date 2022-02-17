<?php

namespace Matrix\Managers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

class EmailManager
{
    public static function sendEmail($emailAddress, $subject, $message)
    {
        $transport = Transport::fromDsn('smtp://no-reply@haarlemfestival.com:no-reply2022@mail.haarlemfestival.com:587');
        $mailer = new Mailer($transport);
        $email = (new Email())
            ->from('no-reply@haarlemfestival.com')
            ->to($emailAddress)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($message);
        $mailer->send($email);
    }

    public static function sendCSSEmail($emailAddress, $subject, $message)
    {
        $transport = Transport::fromDsn('smtp://no-reply@haarlemfestival.com:no-reply2022@mail.haarlemfestival.com:587');
        $mailer = new Mailer($transport);
        $email = (new Email())
            ->from('no-reply@haarlemfestival.com')
            ->to($emailAddress)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($message);
        $mailer->send($email);
    }
}