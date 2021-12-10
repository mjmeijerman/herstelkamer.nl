<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="booked_days")
 */
class BookedDay
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", unique=true)
     */
    protected $date;

    /**
     * @var BookedDayStatus
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public static function create(
        \DateTimeImmutable $date,
        BookedDayStatus $status
    ): self {
        $bookedDay = new self();

        $bookedDay->date   = $date;
        $bookedDay->status = $status;

        return $bookedDay;
    }

    protected function getStatus(): string
    {
        return $this->status->toString();
    }

    protected function setStatus(string $status): void
    {
        $this->status = BookedDayStatus::fromString($status);
    }
}
