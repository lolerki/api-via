<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @assert\type("string")
     */
    private $reference;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Flight", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @assert\notBlank
     */
    private $flight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TravelClass", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @assert\notBlank
     */
    private $travelClass;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criminal", inversedBy="tickets")
     * @assert\notBlank
     */
    private $criminal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getFlight(): ?Flight
    {
        return $this->flight;
    }

    public function setFlight(?Flight $flight): self
    {
        $this->flight = $flight;

        return $this;
    }

    public function getTravelClass(): ?TravelClass
    {
        return $this->travelClass;
    }

    public function setTravelClass(?TravelClass $travelClass): self
    {
        $this->travelClass = $travelClass;

        return $this;
    }

    public function getCriminal(): ?Criminal
    {
        return $this->criminal;
    }

    public function setCriminal(?Criminal $criminal): self
    {
        $this->criminal = $criminal;

        return $this;
    }
}
