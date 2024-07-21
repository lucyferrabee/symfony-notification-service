<?php

namespace App\NotificationPublisher\Infrastructure\Push;

use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;
use Pusher\Pusher;

class PushySender implements NotificationSenderInterface
{
    private Pusher $pusher;

    // public function __construct(Pusher $pusher)
    // {
    //     $this->pusher = $pusher;
    // }

    public function __construct()
    {
    }

    public function send(string $userId, string $message): bool
    {
        // try {
        //     $this->pusher->trigger('my-channel', 'my-event', [
        //         'user_id' => $userId,
        //         'message' => $message,
        //     ]);
        //     return true;
        // } catch (\Exception $e) {
        //     return false;
        // }
        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Pushy notification sent');
        } else {
            var_dump('Pushy notification not sent');
        }
        return $result;
    }
}
