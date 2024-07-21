<?php

namespace App\NotificationPublisher\Infrastructure\SMS;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;

class TwilioSender implements NotificationSenderInterface
{
    public function send(string $userId, string $message): bool
    {
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Twilio SMS sent');
        } else {
            var_dump('Twilio SMS not sent');
        }
        return $result;
    }

    public function supports(string $channel, bool $isSecondary = false): bool
    {
        return $channel === 'email' && !$isSecondary;
    }
}
