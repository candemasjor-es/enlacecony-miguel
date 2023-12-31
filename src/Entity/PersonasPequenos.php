<?php

namespace App\Entity;

use App\Repository\PersonasPequenosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonasPequenosRepository::class)]
class PersonasPequenos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'personasPequenos')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $nombres = null;

    #[ORM\Column(length: 255)]
    private ?string $Apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $tronas = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): static
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): static
    {
        $this->Apellidos = $Apellidos;

        return $this;
    }

    public function getTronas(): ?string
    {
        return $this->tronas;
    }

    public function setTronas(string $tronas): static
    {
        $this->tronas = $tronas;

        return $this;
    }
}
