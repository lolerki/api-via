<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ModelRepository")
 */
class Model
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
     * @var message="nombre de workers par avion. entre 1 et 5"
     */
    private $workers;

    /**
     * @ORM\Column(type="integer")
     * @assert\type("integer")
     * @var message="nombre de place par avion. entre 50 et 200"
     */
    private $places;

    /**
     * @ORM\Column(type="integer")
     * @assert\type("integer")
     * @var message="type d'avion. de 1 à 3"
     */
    private $size;
    /**
     * @ORM\Column(type="integer")
     * @assert\type("integer")
     * @var message="nombre de place dans la soute. entre 100 et 500"
     */
    private $cargo;

    /**
     * @ORM\Column(type="integer")
     * @assert\type("integer")
     * @var message="ndifficulté de l'avion. entre 1 et 3"
     */
    private $complexity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Plane", mappedBy="model")
     */
    private $planes;

    public function __construct()
    {
        $this->planes = new ArrayCollection();
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

    public function getWorkers(): ?int
    {
        return $this->workers;
    }

    public function setWorkers(int $workers): self
    {
        $this->workers = $workers;

        return $this;
    }

    public function getPlaces(): ?int
    {
        return $this->places;
    }

    public function setPlaces(int $places): self
    {
        $this->places = $places;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getCargo(): ?int
    {
        return $this->cargo;
    }

    public function setCargo(int $cargo): self
    {
        $this->cargo = $cargo;

        return $this;
    }

    public function getComplexity(): ?int
    {
        return $this->complexity;
    }

    public function setComplexity(int $complexity): self
    {
        $this->complexity = $complexity;

        return $this;
    }

    /**
     * @return Collection|Plane[]
     */
    public function getPlanes(): Collection
    {
        return $this->planes;
    }

    public function addPlane(Plane $plane): self
    {
        if (!$this->planes->contains($plane)) {
            $this->planes[] = $plane;
            $plane->setModel($this);
        }

        return $this;
    }

    public function removePlane(Plane $plane): self
    {
        if ($this->planes->contains($plane)) {
            $this->planes->removeElement($plane);
            // set the owning side to null (unless already changed)
            if ($plane->getModel() === $this) {
                $plane->setModel(null);
            }
        }

        return $this;
    }
}
