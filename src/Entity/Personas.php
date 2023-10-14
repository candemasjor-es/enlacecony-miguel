<?php

namespace App\Entity;

use App\Repository\PersonasRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonasRepository::class)]
class Personas
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'personas')]
    private ?User $User = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombres = null;

    #[ORM\Column(length: 255)]
    private ?string $Apellidos = null;

    #[ORM\Column(length: 255)]
    private ?string $Elegir_menu = null;

    #[ORM\Column(length: 255)]
    private ?string $Evento = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $otro = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): static
    {
        $this->User = $User;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->Nombres;
    }

    public function setNombres(string $Nombres): static
    {
        $this->Nombres = $Nombres;

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

    public function getElegirMenu(): ?string
    {
        return $this->Elegir_menu;
    }

    public function setElegirMenu(string $Elegir_menu): static
    {
        $this->Elegir_menu = $Elegir_menu;

        return $this;
    }

    public function getEvento(): ?string
    {
        return $this->Evento;
    }

    public function setEvento(string $Evento): static
    {
        $this->Evento = $Evento;

        return $this;
    }

    public function getOtro(): ?string
    {
        return $this->otro;
    }

    public function setOtro(string $otro): static
    {
        $this->otro = $otro;

        return $this;
    }
}
