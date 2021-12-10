<?php

namespace App\Service;

use App\Entity\FailedNotification;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

final class MailerWrapper
{
    public function __construct(
        private MailerInterface $mailer,
        private string $fromAddress,
        private Environment $twig,
        private EntityManager $entityManager
    ) {
    }

    public function send(
        string $subject,
        string $to,
        string $templateLocation,
        array $parameters = []
    ): void {
        try {
            $message = (new Email())
                ->subject($subject)
                ->from($this->fromAddress)
                ->to($to)
                ->html(
                    $this->twig->render(
                        $templateLocation,
                        $parameters
                    )
                );

            $this->mailer->send($message);
        } catch (\Exception $exception) {
            $failedNotification = FailedNotification::create(
                $subject,
                $to,
                $templateLocation,
                $parameters,
                $exception->getMessage()
            );

            $this->addToDB($failedNotification);
        }
    }

    private function addToDB($entity, $detach = null): void
    {
        if ($detach) {
            $this->entityManager->detach($detach);
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
