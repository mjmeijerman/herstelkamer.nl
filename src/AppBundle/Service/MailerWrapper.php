<?php

namespace AppBundle\Service;

use AppBundle\Entity\FailedNotification;
use Doctrine\Common\Persistence\ObjectManager;
use Swift_Mailer;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Templating\EngineInterface;

final class MailerWrapper
{
    /**
     * @var Swift_Mailer
     */
    private $mailer;

    /**
     * @var string
     */
    private $fromAddress;

    /**
     * @var TwigEngine
     */
    private $twig;

    /**
     * @var ObjectManager
     */
    private $entityManager;

    public function __construct(
        Swift_Mailer $mailer,
        string $fromAddress,
        EngineInterface $twig,
        ObjectManager $entityManager
    ) {
        $this->mailer        = $mailer;
        $this->fromAddress   = $fromAddress;
        $this->twig          = $twig;
        $this->entityManager = $entityManager;
    }

    public function send(
        string $subject,
        string $to,
        string $templateLocation,
        array $parameters = []
    ): void {
        try {
            $message = (new \Swift_Message($subject))
                ->setFrom($this->fromAddress)
                ->setTo($to)
                ->setBody(
                    $this->twig->render(
                        $templateLocation,
                        $parameters
                    ),
                    'text/html'
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
