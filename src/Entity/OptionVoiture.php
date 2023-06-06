<?php

namespace App\Entity;

use App\Repository\OptionVoitureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionVoitureRepository::class)]
class OptionVoiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'optionVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Option $IDoption = null;

    #[ORM\ManyToOne(inversedBy: 'optionVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voiture $IDvoiture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDoption(): ?Option
    {
        return $this->IDoption;
    }

    public function setIDoption(?Option $IDoption): self
    {
        $this->IDoption = $IDoption;

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
