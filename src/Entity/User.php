<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Scalar\String_;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface,PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Etude;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $AboutMe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MF;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\ManyToOne(targetEntity=Role::class, inversedBy="users")
     */
    private $Role;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="user")
     */
    private $Annonces;

    /**
     * @ORM\OneToMany(targetEntity=Event::class, mappedBy="Creator")
     */
    private $EventsCreated;

    /**
     * @ORM\ManyToMany(targetEntity=Event::class, inversedBy="Participations")
     */
    private $EventsParticipated;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, cascade={"persist", "remove"})
     */
    private $groupCreated;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="Members")
     */
    private $GroupLinked;

    /**
     * @ORM\OneToMany(targetEntity=Game::class, mappedBy="Developper")
     */
    private $GameDev;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="Players")
     */
    private $GamePlayed;

    /**
     * @ORM\OneToMany(targetEntity=Test::class, mappedBy="tester")
     */
    private $tests;

    /**
     * @ORM\ManyToOne(targetEntity=Game::class, inversedBy="Buyer")
     */
    private $GameToBuy;

    public function __construct()
    {
        $this->Annonces = new ArrayCollection();
        $this->EventsCreated = new ArrayCollection();
        $this->EventsParticipated = new ArrayCollection();
        $this->GameDev = new ArrayCollection();
        $this->GamePlayed = new ArrayCollection();
        $this->tests = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        //$roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        $this->pays = $pays;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getEtude(): ?string
    {
        return $this->Etude;
    }

    public function setEtude(string $Etude): self
    {
        $this->Etude = $Etude;

        return $this;
    }

    public function getAboutMe(): ?string
    {
        return $this->AboutMe;
    }

    public function setAboutMe(string $AboutMe): self
    {
        $this->AboutMe = $AboutMe;

        return $this;
    }

    public function getMF(): ?string
    {
        return $this->MF;
    }

    public function setMF(string $MF): self
    {
        $this->MF = $MF;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->Role;
    }

    public function setRole(?Role $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    /**
     * @return Collection<int, Annonce>
     */
    public function getAnnonces(): Collection
    {
        return $this->Annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->Annonces->contains($annonce)) {
            $this->Annonces[] = $annonce;
            $annonce->setUser($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->Annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getUser() === $this) {
                $annonce->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEventsCreated(): Collection
    {
        return $this->EventsCreated;
    }

    public function addEventsCreated(Event $eventsCreated): self
    {
        if (!$this->EventsCreated->contains($eventsCreated)) {
            $this->EventsCreated[] = $eventsCreated;
            $eventsCreated->setCreator($this);
        }

        return $this;
    }

    public function removeEventsCreated(Event $eventsCreated): self
    {
        if ($this->EventsCreated->removeElement($eventsCreated)) {
            // set the owning side to null (unless already changed)
            if ($eventsCreated->getCreator() === $this) {
                $eventsCreated->setCreator(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEventsParticipated(): Collection
    {
        return $this->EventsParticipated;
    }

    public function addEventsParticipated(Event $eventsParticipated): self
    {
        if (!$this->EventsParticipated->contains($eventsParticipated)) {
            $this->EventsParticipated[] = $eventsParticipated;
        }

        return $this;
    }

    public function removeEventsParticipated(Event $eventsParticipated): self
    {
        $this->EventsParticipated->removeElement($eventsParticipated);

        return $this;
    }

    public function getGroupCreated(): ?Group
    {
        return $this->groupCreated;
    }

    public function setGroupCreated(?Group $groupCreated): self
    {
        $this->groupCreated = $groupCreated;

        return $this;
    }

    public function getGroupLinked(): ?Group
    {
        return $this->GroupLinked;
    }

    public function setGroupLinked(?Group $GroupLinked): self
    {
        $this->GroupLinked = $GroupLinked;

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGameDev(): Collection
    {
        return $this->GameDev;
    }

    public function addGameDev(Game $gameDev): self
    {
        if (!$this->GameDev->contains($gameDev)) {
            $this->GameDev[] = $gameDev;
            $gameDev->setDevelopper($this);
        }

        return $this;
    }

    public function removeGameDev(Game $gameDev): self
    {
        if ($this->GameDev->removeElement($gameDev)) {
            // set the owning side to null (unless already changed)
            if ($gameDev->getDevelopper() === $this) {
                $gameDev->setDevelopper(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Game>
     */
    public function getGamePlayed(): Collection
    {
        return $this->GamePlayed;
    }

    public function addGamePlayed(Game $gamePlayed): self
    {
        if (!$this->GamePlayed->contains($gamePlayed)) {
            $this->GamePlayed[] = $gamePlayed;
        }

        return $this;
    }

    public function removeGamePlayed(Game $gamePlayed): self
    {
        $this->GamePlayed->removeElement($gamePlayed);

        return $this;
    }

    /**
     * @return Collection<int, test>
     */
    public function getTests(): Collection
    {
        return $this->tests;
    }

    public function addTest(test $test): self
    {
        if (!$this->tests->contains($test)) {
            $this->tests[] = $test;
            $test->setTester($this);
        }

        return $this;
    }

    public function removeTest(test $test): self
    {
        if ($this->tests->removeElement($test)) {
            // set the owning side to null (unless already changed)
            if ($test->getTester() === $this) {
                $test->setTester(null);
            }
        }

        return $this;
    }

    public function getGameToBuy(): ?Game
    {
        return $this->GameToBuy;
    }

    public function setGameToBuy(?Game $GameToBuy): self
    {
        $this->GameToBuy = $GameToBuy;

        return $this;
    }
}
