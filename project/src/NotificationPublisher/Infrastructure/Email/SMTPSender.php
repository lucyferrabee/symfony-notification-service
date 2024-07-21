<?php

namespace App\NotificationPublisher\Infrastructure\Email;
use App\NotificationPublisher\Domain\Service\NotificationSenderInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SMTPSender implements NotificationSenderInterface
{
    private MailerInterface $mailer;
    const EMAIL = 'lucy.ferrabee@hotmail.com';

  public function __construct(MailerInterface $mailer)
  {
      $this->mailer = $mailer;
  }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */

    public function send(string $userId, string $message): bool
    {
        $email = (new Email())
            ->from(self::EMAIL)
            ->to('lucy.ferrabee@hotmail.com')
            ->subject('hello')
            ->text($message);

        $this->mailer->send($email);
        return true;
    }
}
