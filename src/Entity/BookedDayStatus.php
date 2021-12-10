<?php

namespace App\Entity;

final class BookedDayStatus
{
    const BOOKED       = 'booked';
    const UNDER_OPTION = 'under_option';

    /**
     * @var string
     */
    private $status;

    public static function BOOKED(): self
    {
        return self::fromString(self::BOOKED);
    }

    public static function UNDER_OPTION(): self
    {
        return self::fromString(self::UNDER_OPTION);
    }

    /**
     * @return self[]
     */
    public static function all()
    {
        return [
            self::BOOKED(),
            self::UNDER_OPTION(),
        ];
    }

    /**
     * @return string[]
     */
    public static function allAsString()
    {
        return [
            self::BOOKED,
            self::UNDER_OPTION,
        ];
    }

    public static function fromString(string $status): self
    {
        $statusObject = new self();
        $statusObject->status = $status;
        $statusObject->protect();

        return $statusObject;
    }

    /**
     * @param mixed $other
     *
     * @return bool
     */
    public function equals($other)
    {
        return $other == $this;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toString();
    }

    private function protect()
    {
        if (!in_array($this->status, $this->allAsString(), true)) {
            throw new \InvalidArgumentException(sprintf('Invalid booked day status %s', $this->status));
        }
    }

    private function __construct()
    {
    }
}
