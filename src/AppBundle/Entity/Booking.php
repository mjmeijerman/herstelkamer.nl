<?php

namespace AppBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

final class Booking
{
    /**
     * @var string|null
     * @Assert\NotBlank(message="Het is verplicht om uw naam in te vullen")
     */
    protected $name;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Het is verplicht om uw adres in te vullen")
     */
    protected $streetNumber;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Het is verplicht om uw postcode in te vullen")
     */
    protected $zipCode;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Het is verplicht om uw woonplaats in te vullen")
     */
    protected $city;

    /**
     * @var string|null
     * @Assert\NotBlank(message="Het is verplicht om uw telefoonnummer in te vullen")
     */
    protected $phoneNumber;

    /**
     * @var string|null
     * @Assert\Email(message="Dit is geen geldig email adres")
     * @Assert\NotBlank(message="Het is verplicht om uw email adres in te vullen")
     */
    protected $emailAddress;

    /**
     * @var \DateTime|null
     * @Assert\Date(message="Dit is geen geldige datum")
     * @Assert\NotBlank(message="Het is verplicht om een startdatum in te vullen")
     */
    protected $bookingStart;

    /**
     * @var \DateTime|null
     * @Assert\Date(message="Dit is geen geldige datum")
     * @Assert\NotBlank(message="Het is verplicht om een einddatum in te vullen")
     */
    protected $bookingEnd;

    /**
     * @var string|null
     */
    protected $remarks;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    public function setStreetNumber(string $streetNumber)
    {
        $this->streetNumber = $streetNumber;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city)
    {
        $this->city = $city;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    public function getBookingStart(): ?\DateTime
    {
        return $this->bookingStart;
    }

    public function setBookingStart(\DateTime $bookingStart)
    {
        $this->bookingStart = $bookingStart;
    }

    public function getBookingEnd(): ?\DateTime
    {
        return $this->bookingEnd;
    }

    public function setBookingEnd(\DateTime $bookingEnd)
    {
        $this->bookingEnd = $bookingEnd;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks)
    {
        $this->remarks = $remarks;
    }
}
