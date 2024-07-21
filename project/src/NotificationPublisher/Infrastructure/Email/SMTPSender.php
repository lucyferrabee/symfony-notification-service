<?php

namespace App\NotificationPublisher\Infrastructure\Email;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SMTPSender implements NotificationSenderInterface
{
    private MailerInterface $mailer;
    const EMAIL = 'lucy.ferrabee@hotmail.com';

    // public function __construct(MailerInterface $mailer)
    // {
    //     $this->mailer = $mailer;
    // }

    public function __construct()
    {
    }

    public function send(string $userId, string $message): bool
    {
        // $email = (new Email())
        //     ->from(self::EMAIL)
        //     ->to('lucy.ferrabee@hotmail.com')
        //     ->subject('hello')
        //     ->text($message);

        // $this->mailer->send($email);
        // return true;
        
        // TODO: implementation of secondary push provider
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('SMTP notification sent');
        } else {
            var_dump('SMTP notification not sent');
        }
        return $result;
    }
}
