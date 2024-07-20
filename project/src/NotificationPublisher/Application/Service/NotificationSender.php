<?php

namespace App\NotificationPublisher\Application\Service;

use App\NotificationPublisher\Infrastructure\Email\EmailSenderInterface;
use App\NotificationPublisher\Infrastructure\SMS\SmsSenderInterface;

class NotificationSender
{
    private EmailSenderInterface $emailSender;
    private SmsSenderInterface $smsSender;

    public function __construct(EmailSenderInterface $emailSender, SmsSenderInterface $smsSender)
    {
        $this->emailSender = $emailSender;
        $this->smsSender = $smsSender;
    }

    public function send(string $userId, string $message, string $channel)
    {
        switch ($channel) {
            case 'email':
                $this->emailSender->send($userId, $message);
                break;
            case 'sms':
                $this->smsSender->send($userId, $message);
                break;
            default:
                throw new \InvalidArgumentException('Unsupported notification channel');
        }
    }
}
