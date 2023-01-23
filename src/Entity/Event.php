<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 */
class Event
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
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="EventsCreated")
     */
    private $Creator;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="EventsParticipated")
     */
    private $Participations;

    public function __construct()
    {
        $this->Participations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

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
    public function getParticipations(): Collection
    {
        return $this->Participations;
    }

    public function addParticipation(User $participation): self
    {
        if (!$this->Participations->contains($participation)) {
            $this->Participations[] = $participation;
            $participation->addEventsParticipated($this);
        }

        return $this;
    }

    public function removeParticipation(User $participation): self
    {
        if ($this->Participations->removeElement($participation)) {
            $participation->removeEventsParticipated($this);
        }

        return $this;
    }

}
