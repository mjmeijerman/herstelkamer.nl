<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="failed_notifications")
 */
class FailedNotification
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $subject;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $recipient;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    protected $templateLocation;

    /**
     * @var array
     * @ORM\Column(name="parameters", type="array")
     */
    protected $parameters;

    /**
     * @var string
     * @ORM\Column(type="text", length=255)
     */
    protected $errorMessage;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $lastTriedAt;

    public static function create(
        string $subject,
        string $recipient,
        string $templateLocation,
        array $parameters,
        string $errorMessage
    ): self {
        $failedNotification = new self();

        $failedNotification->subject          = $subject;
        $failedNotification->recipient        = $recipient;
        $failedNotification->templateLocation = $templateLocation;
        $failedNotification->parameters       = $parameters;
        $failedNotification->errorMessage     = $errorMessage;
        $failedNotification->lastTriedAt      = new \DateTime('now', new \DateTimeZone('Europe/Amsterdam'));

        return $failedNotification;
    }
}
