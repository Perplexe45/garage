<?php

namespace App\Entity;

use App\Repository\InfoSpecialeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InfoSpecialeRepository::class)]
class InfoSpeciale
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $designation = null;

    #[ORM\ManyToOne(inversedBy: 'infoSpeciales')]
    private ?Employe $IDemploye = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->designation;
    }

    public function setDesignation(string $designation): self
    {
        $this->designation = $designation;

        return $this;
    }

    public function getIDemploye(): ?Employe
    {
        return $this->IDemploye;
    }

    public function setIDemploye(?Employe $IDemploye): self
    {
        $this->IDemploye = $IDemploye;

        return $this;
    }
}
