<?php

namespace App\NotificationPublisher\Infrastructure\Email;

class AwsSesEmailSender implements EmailSenderInterface
{
    public function send(string $userId, string $message): void
    {
        var_dump('email sent');
    }
}
