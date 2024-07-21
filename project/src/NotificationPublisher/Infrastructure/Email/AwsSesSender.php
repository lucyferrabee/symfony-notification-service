<?php

namespace App\NotificationPublisher\Infrastructure\Email;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class AwsSesSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message): bool
    {
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('AWS SES email sent');
        } else {
            var_dump('AWS SES email not sent');
        }
        return $result;
    }
}
