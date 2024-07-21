<?php

namespace App\NotificationPublisher\Infrastructure\SMS;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Twilio\Rest\Client;

class WhatsappSender implements NotificationSenderInterface
{
    private Client $twilioClient;

    // public function __construct(Client $twilioClient)
    // {
    //     $this->twilioClient = $twilioClient;
    // }

    public function __construct()
    {
    }

    public function send(string $userId, string $message): bool
    {    
        // $twilio = $this->twilioClient;
    
        // $message = $twilio->messages
        //   ->create("whatsapp:+447903690560",
        //     [
        //         "from" => "whatsapp:+14155238886",
        //         "body" => 'Your appointment is coming up on July 21 at 3PM'
        //     ]
        //   );

        $result = (bool)random_int(0, 1);
        if ($result) {
            var_dump('Whatsapp notification sent');
        } else {
            var_dump('Whatsapp notification not sent');
        }
        return $result;
    }
}
