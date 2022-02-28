<?php

namespace Matrix\Managers;

use eftec\bladeone\BladeOne;
use Exception;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;

class EmailManager
{

    /**
     * @throws TransportExceptionInterface
     * @throws Exception
     */
    public function __construct($emailAddress, $subject, $blade_name, $args = array())
    {
        $blade = new BladeOne(dirname(__DIR__, 3) . "/resources/views",dirname(__DIR__, 3) . "/public/views",BladeOne::MODE_DEBUG);
        $blade->run('emails.signup',[]);

        $transport = Transport::fromDsn('smtp://no-reply@haarlemfestival.com:no-reply2022@mail.haarlemfestival.com:587');
        $mailer = new Mailer($transport);
        $email = (new Email())
            ->from('no-reply@haarlemfestival.com')
            ->to($emailAddress)
            ->subject($subject)
            ->html(html_entity_decode($blade->run($blade_name, $args)));

        $mailer->send($email);
    }
}