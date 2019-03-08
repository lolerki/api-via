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
 *              "normalization_context"={"groups"={"travel_get_collection"}}
 *          },
 *          "post"={
 *             "method"="POST",
 *             "normalization_context"={"groups"={"travel_post_collection"}}
 *          }
 *     },
 *     itemOperations={
 *           "get"={
 *             "method"="GET",
 *             "normalization_context"={"groups"={"travel_get_item"}}
 *            },
 *           "put"={
 *             "method"="PUT",
 *             "normalization_context"={"groups"={"travel_put_item"}}
 *           },
 *           "delete"={
 *             "method"="DELETE",
 *             "normalization_context"={"groups"={"travel_delete_item"}}
 *          }
 *     }
 *  )
 * @ORM\Entity(repositoryClass="App\Repository\PilotRepository")
 */
class Pilot
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
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="integer")
     */
    private $skill;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Crime", inversedBy="pilots")
     * @ORM\JoinColumn(nullable=false)
     */
    private $crime;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assignation", mappedBy="pilot")
     */
    private $assignations;

    public function __construct()
    {
        $this->assignations = new ArrayCollection();
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

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSkill(): ?int
    {
        return $this->skill;
    }

    public function setSkill(int $skill): self
    {
        $this->skill = $skill;

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
            $assignation->setPilot($this);
        }

        return $this;
    }

    public function removeAssignation(Assignation $assignation): self
    {
        if ($this->assignations->contains($assignation)) {
            $this->assignations->removeElement($assignation);
            // set the owning side to null (unless already changed)
            if ($assignation->getPilot() === $this) {
                $assignation->setPilot(null);
            }
        }

        return $this;
    }
}
