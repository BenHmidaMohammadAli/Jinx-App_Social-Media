<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
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
     * @ORM\Column(type="string", length=255)
     */
    private $Genre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $alert;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;


    /**
     * @ORM\OneToMany(targetEntity=Test::class, mappedBy="game")
     */
    private $tests;

    /**
     * @ORM\OneToMany(targetEntity=Achat::class, mappedBy="Game")
     */
    private $achats;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="GameDev")
     */
    private $Developper;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="GamePlayed")
     */
    private $Players;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="GameToBuy")
     */
    private $Buyer;

    public function __construct()
    {
        $this->tests = new ArrayCollection();
        $this->achats = new ArrayCollection();
        $this->Players = new ArrayCollection();
        $this->Buyer = new ArrayCollection();
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

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(string $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getAlert(): ?string
    {
        return $this->alert;
    }

    public function setAlert(string $alert): self
    {
        $this->alert = $alert;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection<int, Test>
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(Test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->setGame($this);
        }

        return $this;
    }

    public function removeTest(Test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getGame() === $this) {
                $test->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Achat>
     */
    public function getAchats(): Collection
    {
        return $this->achats;
    }

    public function addAchat(Achat $achat): self
    {
        if (!$this->achats->contains($achat)) {
            $this->achats[] = $achat;
            $achat->setGame($this);
        }

        return $this;
    }

    public function removeAchat(Achat $achat): self
    {
        if ($this->achats->removeElement($achat)) {
            // set the owning side to null (unless already changed)
            if ($achat->getGame() === $this) {
                $achat->setGame(null);
            }
        }

        return $this;
    }

    public function getDevelopper(): ?User
    {
        return $this->Developper;
    }

    public function setDevelopper(?User $Developper): self
    {
        $this->Developper = $Developper;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPlayers(): Collection
    {
        return $this->Players;
    }

    public function addPlayer(User $player): self
    {
        if (!$this->Players->contains($player)) {
            $this->Players[] = $player;
            $player->addGamePlayed($this);
        }

        return $this;
    }

    public function removePlayer(User $player): self
    {
        if ($this->Players->removeElement($player)) {
            $player->removeGamePlayed($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getBuyer(): Collection
    {
        return $this->Buyer;
    }

    public function addBuyer(User $buyer): self
    {
        if (!$this->Buyer->contains($buyer)) {
            $this->Buyer[] = $buyer;
            $buyer->setGameToBuy($this);
        }

        return $this;
    }

    public function removeBuyer(User $buyer): self
    {
        if ($this->Buyer->removeElement($buyer)) {
            // set the owning side to null (unless already changed)
            if ($buyer->getGameToBuy() === $this) {
                $buyer->setGameToBuy(null);
            }
        }

        return $this;
    }


}
