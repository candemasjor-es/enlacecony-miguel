<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $surnames = null;

    #[ORM\Column(length: 11)]
    private ?string $phome = null;

    #[ORM\OneToMany(mappedBy: 'User_id', targetEntity: ElegirMenu::class)]
    private Collection $elegirMenus;

    #[ORM\OneToMany(mappedBy: 'User_id_evento', targetEntity: Evento::class)]
    private Collection $eventos;

    public function __construct()
    {
        $this->elegirMenus = new ArrayCollection();
        $this->eventos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
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
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        //$roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getSurnames(): ?string
    {
        return $this->surnames;
    }

    public function setSurnames(string $surnames): static
    {
        $this->surnames = $surnames;

        return $this;
    }

    public function getPhome(): ?string
    {
        return $this->phome;
    }

    public function setPhome(string $phome): static
    {
        $this->phome = $phome;

        return $this;
    }

    /**
     * @return Collection<int, ElegirMenu>
     */
    public function getElegirMenus(): Collection
    {
        return $this->elegirMenus;
    }

    public function addElegirMenu(ElegirMenu $elegirMenu): static
    {
        if (!$this->elegirMenus->contains($elegirMenu)) {
            $this->elegirMenus->add($elegirMenu);
            $elegirMenu->setUserId($this);
        }

        return $this;
    }

    public function removeElegirMenu(ElegirMenu $elegirMenu): static
    {
        if ($this->elegirMenus->removeElement($elegirMenu)) {
            // set the owning side to null (unless already changed)
            if ($elegirMenu->getUserId() === $this) {
                $elegirMenu->setUserId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evento>
     */
    public function getEventos(): Collection
    {
        return $this->eventos;
    }

    public function addEvento(Evento $evento): static
    {
        if (!$this->eventos->contains($evento)) {
            $this->eventos->add($evento);
            $evento->setUserIdEvento($this);
        }

        return $this;
    }

    public function removeEvento(Evento $evento): static
    {
        if ($this->eventos->removeElement($evento)) {
            // set the owning side to null (unless already changed)
            if ($evento->getUserIdEvento() === $this) {
                $evento->setUserIdEvento(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getId();
    }
   
}
