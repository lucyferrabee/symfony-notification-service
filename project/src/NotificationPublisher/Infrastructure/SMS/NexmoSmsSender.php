<?php

namespace App\NotificationPublisher\Infrastructure\SMS;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class NexmoSmsSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message, string $channel): bool
    {
        if ($channel !== 'sms') {
            throw new \InvalidArgumentException('Unsupported notification channel');
        }

        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Nexmo SMS sent');
        } else {
            var_dump('Nexmo SMS not sent');
        }
        return $result;
    }

    public function supports(string $channel): bool
    {
        return $channel === 'sms';
    }
}
