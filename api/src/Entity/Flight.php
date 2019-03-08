<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *     collectionOperations={
 *           "get"={
 *              "normalization_context"={"groups"={"flight_get_collection"}}
 *          },
 *          "post"={
 *             "method"="POST",
 *             "normalization_context"={"groups"={"flight_post_collection"}}
 *          }
 *     },
 *     itemOperations={
 *           "get"={
 *             "method"="GET",
 *             "normalization_context"={"groups"={"flight_get_item"}}
 *            },
 *           "put"={
 *             "method"="PUT",
 *             "normalization_context"={"groups"={"flight_put_item"}}
 *           },
 *           "delete"={
 *             "method"="DELETE",
 *             "normalization_context"={"groups"={"flight_delete_item"}}
 *          }
 *     }
 *  )
 * @ORM\Entity(repositoryClass="App\Repository\FlightRepository")
 */
class Flight
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departure;

    /**
     * @ORM\Column(type="datetime")
     */
    private $departureTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Destination", inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $destination;

    /**
     * @ORM\Column(type="datetime")
     */
    private $arrivingTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Plane", inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plane;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Runway", inversedBy="flights")
     * @ORM\JoinColumn(nullable=false)
     */
    private $runway;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="flight")
     */
    private $tickets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assignation", mappedBy="flight")
     */
    private $assignations;

    /**
     * @ORM\JoinTable(name="shipment")
     * @ORM\ManyToMany(targetEntity="App\Entity\Product", inversedBy="shipment")
     */
    private $shipment;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->assignations = new ArrayCollection();
        $this->shipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeparture(): ?Destination
    {
        return $this->departure;
    }

    public function setDeparture(Destination $departure): self
    {
        $this->departure = $departure;

        return $this;
    }

    public function getDepartureTime(): ?\DateTimeInterface
    {
        return $this->departureTime;
    }

    public function setDepartureTime(\DateTimeInterface $departureTime): self
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    public function getDestination(): ?Destination
    {
        return $this->destination;
    }

    public function setDestination(?Destination $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getArrivingTime(): ?\DateTimeInterface
    {
        return $this->arrivingTime;
    }

    public function setArrivingTime(\DateTimeInterface $arrivingTime): self
    {
        $this->arrivingTime = $arrivingTime;

        return $this;
    }

    public function getPlane(): ?Plane
    {
        return $this->plane;
    }

    public function setPlane(?Plane $plane): self
    {
        $this->plane = $plane;

        return $this;
    }

    public function getRunway(): ?Runway
    {
        return $this->runway;
    }

    public function setRunway(?Runway $runway): self
    {
        $this->runway = $runway;

        return $this;
    }

    /**
     * @return Collection|Ticket[]
     */
    public function getTickets(): Collection
    {
        return $this->tickets;
    }

    public function addTicket(Ticket $ticket): self
    {
        if (!$this->tickets->contains($ticket)) {
            $this->tickets[] = $ticket;
            $ticket->setFlight($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getFlight() === $this) {
                $ticket->setFlight(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Assignation[]
     */
    public function getAssignations(): Collection
    {
        return $this->assignations;
    }

    public function addAssignation(Assignation $assignation): self
    {
        if (!$this->assignations->contains($assignation)) {
            $this->assignations[] = $assignation;
            $assignation->setFlight($this);
        }

        return $this;
    }

    public function removeAssignation(Assignation $assignation): self
    {
        if ($this->assignations->contains($assignation)) {
            $this->assignations->removeElement($assignation);
            // set the owning side to null (unless already changed)
            if ($assignation->getFlight() === $this) {
                $assignation->setFlight(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getShipment(): Collection
    {
        return $this->shipment;
    }

    public function addShipment(Product $shipment): self
    {
        if (!$this->shipment->contains($shipment)) {
            $this->shipment[] = $shipment;
        }

        return $this;
    }

    public function removeShipment(Product $shipment): self
    {
        if ($this->shipment->contains($shipment)) {
            $this->shipment->removeElement($shipment);
        }

        return $this;
    }
}
