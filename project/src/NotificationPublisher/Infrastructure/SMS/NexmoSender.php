<?php

namespace App\NotificationPublisher\Infrastructure\SMS;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class NexmoSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message): bool
    {
        // TODO: implementation of secondary sms provider
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Nexmo SMS sent');
        } else {
            var_dump('Nexmo SMS not sent');
        }
        return $result;
    }

    public function supports(string $channel, bool $isSecondary = false): bool
    {
        return $channel === 'sms' && $isSecondary;
    }
}
