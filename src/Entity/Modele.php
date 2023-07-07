<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'IDmodele', targetEntity: Voiture::class)]
    private Collection $voitures;

    #[ORM\ManyToOne(targetEntity: Marque::class)]
    #[ORM\JoinColumn(name: "id_marque", referencedColumnName: "id")]
    private ?Marque $IDmarque = null;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
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

    public function __toString()    //Il faut renvoyer un "get' ou la propriété déclaré est un "String", mais un 'get gégnéré dans la classe 'Modele'
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function getIDmarque(): ?Marque
    {
        return $this->IDmarque;
    }

    public function setIDmarque(?Marque $IDmarque): self
    {
        $this->IDmarque = $IDmarque;
        return $this;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setIDmodele($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getIDmodele() === $this) {
                $voiture->setIDmodele(null);
            }
        }

        return $this;
    }
}
