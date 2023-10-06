<?php

namespace App\Entity;

use App\Repository\ElegirMenuRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ElegirMenuRepository::class)]
class ElegirMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'elegirMenus')]
    private ?User $User_id = null;

    #[ORM\Column(length: 255)]
    private ?string $Menu_name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->User_id;
    }

    public function setUserId(?User $User_id): static
    {
        $this->User_id = $User_id;

        return $this;
    }

    public function getMenuName(): ?string
    {
        return $this->Menu_name;
    }

    public function setMenuName(string $Menu_name): static
    {
        $this->Menu_name = $Menu_name;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }
}
