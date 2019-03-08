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
 *              "normalization_context"={"groups"={"crime_get_collection"}}
 *          },
 *          "post"={
 *             "method"="POST",
 *             "normalization_context"={"groups"={"crime_post_collection"}}
 *          }
 *     },
 *     itemOperations={
 *           "get"={
 *             "method"="GET",
 *             "normalization_context"={"groups"={"crime_get_item"}}
 *            },
 *           "put"={
 *             "method"="PUT",
 *             "normalization_context"={"groups"={"crime_put_item"}}
 *           },
 *           "delete"={
 *             "method"="DELETE",
 *             "normalization_context"={"groups"={"crime_delete_item"}}
 *          }
 *     }
 *  )
 * @ORM\Entity(repositoryClass="App\Repository\CrimeRepository")
 */
class Crime
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
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Criminal", mappedBy="crime")
     */
    private $criminals;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pilot", mappedBy="crime")
     */
    private $pilots;

    public function __construct()
    {
        $this->criminals = new ArrayCollection();
        $this->pilots = new ArrayCollection();
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

    /**
     * @return Collection|Criminal[]
     */
    public function getCriminals(): Collection
    {
        return $this->criminals;
    }

    public function addCriminal(Criminal $criminal): self
    {
        if (!$this->criminals->contains($criminal)) {
            $this->criminals[] = $criminal;
            $criminal->setCrime($this);
        }

        return $this;
    }

    public function removeCriminal(Criminal $criminal): self
    {
        if ($this->criminals->contains($criminal)) {
            $this->criminals->removeElement($criminal);
            // set the owning side to null (unless already changed)
            if ($criminal->getCrime() === $this) {
                $criminal->setCrime(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pilot[]
     */
    public function getPilots(): Collection
    {
        return $this->pilots;
    }

    public function addPilot(Pilot $pilot): self
    {
        if (!$this->pilots->contains($pilot)) {
            $this->pilots[] = $pilot;
            $pilot->setCrime($this);
        }

        return $this;
    }

    public function removePilot(Pilot $pilot): self
    {
        if ($this->pilots->contains($pilot)) {
            $this->pilots->removeElement($pilot);
            // set the owning side to null (unless already changed)
            if ($pilot->getCrime() === $this) {
                $pilot->setCrime(null);
            }
        }

        return $this;
    }
}
