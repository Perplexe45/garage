<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'services')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employe $IDemploye = null;

    #[ORM\OneToMany(mappedBy: 'IDservice', targetEntity: Description::class)]
    private Collection $descriptions;

    #[ORM\OneToMany(mappedBy: 'IDservice', targetEntity: Realiser::class)]
    private Collection $realisers;

    #[ORM\OneToMany(mappedBy: 'IDservice', targetEntity: Evocation::class)]
    private Collection $evocations;

    public function __construct()
    {
        $this->descriptions = new ArrayCollection();
        $this->realisers = new ArrayCollection();
        $this->evocations = new ArrayCollection();
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

    public function getIDemploye(): ?Employe
    {
        return $this->IDemploye;
    }

    public function setIDemploye(?Employe $IDemploye): self
    {
        $this->IDemploye = $IDemploye;

        return $this;
    }

    /**
     * @return Collection<int, Description>
     */
    public function getDescriptions(): Collection
    {
        return $this->descriptions;
    }

    public function __toString()   
    {
        return $this->getNom();
    }


    public function addDescription(Description $description): self
    {
        if (!$this->descriptions->contains($description)) {
            $this->descriptions->add($description);
            $description->setIDservice($this);
        }

        return $this;
    }

    public function removeDescription(Description $description): self
    {
        if ($this->descriptions->removeElement($description)) {
            // set the owning side to null (unless already changed)
            if ($description->getIDservice() === $this) {
                $description->setIDservice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Realiser>
     */
    public function getRealisers(): Collection
    {
        return $this->realisers;
    }

    public function addRealiser(Realiser $realiser): self
    {
        if (!$this->realisers->contains($realiser)) {
            $this->realisers->add($realiser);
            $realiser->setIDservice($this);
        }

        return $this;
    }

    public function removeRealiser(Realiser $realiser): self
    {
        if ($this->realisers->removeElement($realiser)) {
            // set the owning side to null (unless already changed)
            if ($realiser->getIDservice() === $this) {
                $realiser->setIDservice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Evocation>
     */
    public function getEvocations(): Collection
    {
        return $this->evocations;
    }

    public function addEvocation(Evocation $evocation): self
    {
        if (!$this->evocations->contains($evocation)) {
            $this->evocations->add($evocation);
            $evocation->setIDservice($this);
        }

        return $this;
    }

    public function removeEvocation(Evocation $evocation): self
    {
        if ($this->evocations->removeElement($evocation)) {
            // set the owning side to null (unless already changed)
            if ($evocation->getIDservice() === $this) {
                $evocation->setIDservice(null);
            }
        }

        return $this;
    }
}
