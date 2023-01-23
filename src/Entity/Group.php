<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @ORM\OneToOne(targetEntity=User::class, cascade={"persist", "remove"})
     */
    private $Creator;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="GroupLinked")
     */
    private $Members;

    public function __construct()
    {
        $this->Members = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->Creator;
    }

    public function setCreator(?User $Creator): self
    {
        $this->Creator = $Creator;
        return $this;
    }



    /**
     * @return Collection<int, User>
     */
    public function getMembers(): Collection
    {
        return $this->Members;
    }

    public function addMember(User $member): self
    {
        if (!$this->Members->contains($member)) {
            $this->Members[] = $member;
            $member->setGroupLinked($this);
        }

        return $this;
    }

    public function removeMember(User $member): self
    {
        if ($this->Members->removeElement($member)) {
            // set the owning side to null (unless already changed)
            if ($member->getGroupLinked() === $this) {
                $member->setGroupLinked(null);
            }
        }

        return $this;
    }


}
