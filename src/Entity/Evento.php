<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'eventos')]
    private ?User $User_id_evento = null;

    #[ORM\Column(length: 255)]
    private ?string $eventos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserIdEvento(): ?User
    {
        return $this->User_id_evento;
    }

    public function setUserIdEvento(?User $User_id_evento): static
    {
        $this->User_id_evento = $User_id_evento;

        return $this;
    }

    public function getEventos(): ?string
    {
        return $this->eventos;
    }

    public function setEventos(string $eventos): static
    {
        $this->eventos = $eventos;

        return $this;
    }
}
