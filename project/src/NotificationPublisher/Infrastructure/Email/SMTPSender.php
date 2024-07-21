<?php

namespace App\NotificationPublisher\Infrastructure\Email;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class SMTPSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message): bool
    {
        // TODO: implementation of secondary email provider
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('SMTP email sent');
        } else {
            var_dump('SMTP email not sent');
        }
        return $result;
    }
}
