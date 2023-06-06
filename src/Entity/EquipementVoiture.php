<?php

namespace App\Entity;

use App\Repository\EquipementVoitureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementVoitureRepository::class)]
class EquipementVoiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'equipementVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voiture $IDvoiture = null;

    #[ORM\ManyToOne(inversedBy: 'equipementVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipement $IDequipement = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIDequipement(): ?Equipement
    {
        return $this->IDequipement;
    }

    public function setIDequipement(?Equipement $IDequipement): self
    {
        $this->IDequipement = $IDequipement;

        return $this;
    }
}
