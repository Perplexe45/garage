<?php

namespace App\Entity;

use App\Repository\EquipementVoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'IDequipement', targetEntity: Voiture::class)]
    private Collection $voitures;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setIDequipement($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getIDequipement() === $this) {
                $voiture->setIDequipement(null);
            }
        }

        return $this;
    }
}
