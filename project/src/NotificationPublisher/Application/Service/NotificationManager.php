<?php

namespace App\NotificationPublisher\Application\Service;

use InvalidArgumentException;

class NotificationManager
{
    private iterable $notificationSenders;
    private array $channelConfig;

    public function __construct(iterable $notificationSenders, array $channelConfig)
    {
        $this->notificationSenders = $notificationSenders;
        $this->channelConfig = $channelConfig;
    }

    public function send(string $userId, string $message, string $primaryChannel, string $fallbackChannel): array
    {
        $result = [];
        $primarySuccess = $this->sendWithChannel($userId, $message, $primaryChannel);
        $result[] = $primarySuccess;

        if (!$primarySuccess) {
            $secondarySuccess = $this->sendWithChannel($userId, $message, $primaryChannel, true);
            $result[] = $secondarySuccess;

            if (!$secondarySuccess) {
                $newChannelAttempt = $this->sendWithChannel($userId, $message, $fallbackChannel);
                $result[] = $newChannelAttempt;
                
                    if (!$newChannelAttempt) {
                        $finalAttempt = $this->sendWithChannel($userId, $message, $fallbackChannel, true);
                        $result[] = $finalAttempt;
                    }
            }
        }

        return $result;
    }

    private function sendWithChannel(string $userId, string $message, string $channel, bool $isSecondary = false): bool
    {
        $channelConfig = $this->channelConfig[$channel] ?? null;

        if (!$channelConfig) {
            throw new InvalidArgumentException("No configuration found for channel: {$channel}");
        }

        $service = $isSecondary ? $channelConfig['secondary'] : $channelConfig['primary'];

        foreach ($this->notificationSenders as $sender) {
            if ($sender instanceof $service) {
                return $sender->send($userId, $message);
            }
        }

        // TODO: if all channels are down, delay and re-send later

        throw new InvalidArgumentException("Service {$service} does not implement NotificationSenderInterface");
    }
}