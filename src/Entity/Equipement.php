<?php

namespace App\Entity;

use App\Repository\EquipementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipementRepository::class)]
class Equipement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'IDequipement', targetEntity: EquipementVoiture::class)]
    private Collection $equipementVoitures;

    public function __construct()
    {
        $this->equipementVoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function __toString()    //Il faut renvoyer un "get' ou la propriété déclaré est un "String", mais un 'get gégnéré dans la classe 'Equipement'
    {
        return $this->getNom();
    }


    /**
     * @return Collection<int, EquipementVoiture>
     */
    public function getEquipementVoitures(): Collection
    {
        return $this->equipementVoitures;
    }

      /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $selectedEquipements;

    // ...

    public function getSelectedEquipements(): ?array
    {
        return $this->selectedEquipements;
    }

    public function setSelectedEquipements(?array $selectedEquipements): self
    {
        $this->selectedEquipements = $selectedEquipements;

        return $this;
    }

    public function addEquipementVoiture(EquipementVoiture $equipementVoiture): self
    {
        if (!$this->equipementVoitures->contains($equipementVoiture)) {
            $this->equipementVoitures->add($equipementVoiture);
            $equipementVoiture->setIDequipement($this);
        }

        return $this;
    }
    

    public function removeEquipementVoiture(EquipementVoiture $equipementVoiture): self
    {
        if ($this->equipementVoitures->removeElement($equipementVoiture)) {
            // set the owning side to null (unless already changed)
            if ($equipementVoiture->getIDequipement() === $this) {
                $equipementVoiture->setIDequipement(null);
            }
        }

        return $this;
    }
}
