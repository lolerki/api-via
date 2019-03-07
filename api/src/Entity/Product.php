<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\type("string")
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     * @assert\type("integer")
     * @var message="dangerersité du produit de 1 à 10"
     */
    private $dangerousness;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\JoinTable(name="shipment")
     * @ORM\ManyToMany(targetEntity="App\Entity\Flight", mappedBy="shipment")
     */
    private $shipment;

    public function __construct()
    {
        $this->shipment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDangerousness(): ?int
    {
        return $this->dangerousness;
    }

    public function setDangerousness(int $dangerousness): self
    {
        $this->dangerousness = $dangerousness;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Flight[]
     */
    public function getShipment(): Collection
    {
        return $this->shipment;
    }

    public function addShipment(Flight $shipment): self
    {
        if (!$this->shipment->contains($shipment)) {
            $this->shipment[] = $shipment;
            $shipment->addShipment($this);
        }

        return $this;
    }

    public function removeShipment(Flight $shipment): self
    {
        if ($this->shipment->contains($shipment)) {
            $this->shipment->removeElement($shipment);
            $shipment->removeShipment($this);
        }

        return $this;
    }
}
