<?php

namespace App\NotificationPublisher\Infrastructure\Email;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Twilio\Rest\Client;

class WhatsappSender implements NotificationSenderInterface
{
    private Client $twilioClient;

    public function __construct(Client $twilioClient)
    {
        $this->twilioClient = $twilioClient;
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

        return true;
    }
}
