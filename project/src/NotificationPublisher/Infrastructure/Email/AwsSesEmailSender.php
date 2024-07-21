<?php

namespace App\NotificationPublisher\Infrastructure\Email;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class AwsSesEmailSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message, string $channel): bool
    {
        if ($channel !== 'email') {
            throw new \InvalidArgumentException('Unsupported notification channel');
        }

        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('AWS SES email sent');
        } else {
            var_dump('AWS SES email not sent');
        }
        return $result;
    }

    public function supports(string $channel): bool
    {
        return $channel === 'email';
    }
}
