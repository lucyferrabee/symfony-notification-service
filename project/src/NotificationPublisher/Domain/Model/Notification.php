<?php

namespace App\NotificationPublisher\Domain\Model;

class Notification
{
    private string $userId;
    private string $message;
    private string $channel;
    private string $fallbackChannel;

    public function __construct(string $userId, string $message, string $channel, string $fallbackChannel)
    {
        $this->userId = $userId;
        $this->message = $message;
        $this->channel = $channel;
        $this->fallbackChannel = $fallbackChannel;
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

    public function getFallbackChannel(): string
    {
        return $this->fallbackChannel;
    }
}
