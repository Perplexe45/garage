<?php

namespace App\Entity;

use App\Repository\OptionVoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private ?Options $IDoptions = null;

    #[ORM\ManyToOne(inversedBy: 'optionVoitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voiture $IDvoiture = null;

    #[ORM\OneToMany(mappedBy: 'IDoption', targetEntity: Voiture::class)]
    private Collection $voitures;

    // New property added
    #[ORM\Column(nullable: true)]
    private ?string $option = null;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIDoptions(): ?Options
    {
        return $this->IDoptions;
    }

    public function setIDoptions(?Options $IDoptions): self
    {
        $this->IDoptions = $IDoptions;

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

    public function __toString()
    {
        return $this->getOption() ?? ''; // Retourne une chaîne vide si $option est nulle
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
            $voiture->setIDoption($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getIDoption() === $this) {
                $voiture->setIDoption(null);
            }
        }

        return $this;
    }

    // Getter and setter for the "option" property
    public function getOption(): ?string
    {
        return $this->option;
    }

    public function setOption(?string $option): self
    {
        $this->option = $option;

        return $this;
    }
}