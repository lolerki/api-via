<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CriminalRepository")
 */
class Criminal
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Crime", inversedBy="criminals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $crime;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Ticket", mappedBy="criminal")
     */
    private $tickets;

    /**
     * @ORM\JoinTable(name="luggage")
     * @ORM\ManyToMany(targetEntity="App\Entity\Type", inversedBy="luggage")
     */
    private $luggage;

    public function __construct()
    {
        $this->tickets = new ArrayCollection();
        $this->luggage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getCrime(): ?Crime
    {
        return $this->crime;
    }

    public function setCrime(?Crime $crime): self
    {
        $this->crime = $crime;

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
            $ticket->setCriminal($this);
        }

        return $this;
    }

    public function removeTicket(Ticket $ticket): self
    {
        if ($this->tickets->contains($ticket)) {
            $this->tickets->removeElement($ticket);
            // set the owning side to null (unless already changed)
            if ($ticket->getCriminal() === $this) {
                $ticket->setCriminal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Type[]
     */
    public function getLuggage(): Collection
    {
        return $this->luggage;
    }

    public function addLuggage(Type $luggage): self
    {
        if (!$this->luggage->contains($luggage)) {
            $this->luggage[] = $luggage;
        }

        return $this;
    }

    public function removeLuggage(Type $luggage): self
    {
        if ($this->luggage->contains($luggage)) {
            $this->luggage->removeElement($luggage);
        }

        return $this;
    }
}
