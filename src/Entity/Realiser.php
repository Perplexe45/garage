<?php

namespace App\Entity;

use App\Repository\RealiserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RealiserRepository::class)]
class Realiser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $heure = null;

    #[ORM\ManyToOne(inversedBy: 'realisers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Service $IDservice = null;

    #[ORM\ManyToOne(inversedBy: 'realisers')]
    private ?Voiture $IDvoiture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(?\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getIDservice(): ?Service
    {
        return $this->IDservice;
    }

    public function setIDservice(?Service $IDservice): self
    {
        $this->IDservice = $IDservice;

        return $this;
    }

    public function getIDvoiture(): ?Voiture
    {
        return $this->IDvoiture;
    }

    public function setIDvoiture(?Voiture $IDvoiture): self
    {
        $this->IDvoiture = $IDvoiture;

        return $this;
    }
}
