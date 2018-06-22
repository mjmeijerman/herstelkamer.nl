<?php

namespace AppBundle\Service;

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

    public function __construct(Swift_Mailer $mailer, string $fromAddress, EngineInterface $twig)
    {
        $this->mailer      = $mailer;
        $this->fromAddress = $fromAddress;
        $this->twig        = $twig;
    }

    public function send(
        string $subject,
        string $to,
        string $templateLocation,
        array $parameters = []
    ) {
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
    }
}
