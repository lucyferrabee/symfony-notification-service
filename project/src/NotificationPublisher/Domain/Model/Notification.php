<?php

namespace App\NotificationPublisher\Domain\Model;

class Notification
{
    private string $userId;
    private string $message;
    private string $channel;

    public function __construct(string $userId, string $message, string $channel)
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->channel = $channel;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }
}
