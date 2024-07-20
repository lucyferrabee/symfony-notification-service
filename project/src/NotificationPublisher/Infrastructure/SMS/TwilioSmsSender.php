<?php

namespace App\NotificationPublisher\Infrastructure\SMS;

class TwilioSmsSender implements SmsSenderInterface
{
    public function send(string $userId, string $message): void
    {
        // Twilio SMS logic to send message
    }
}
