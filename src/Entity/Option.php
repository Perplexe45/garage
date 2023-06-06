<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionRepository::class)]
#[ORM\Table(name: '`option`')]
class Option
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'IDoption', targetEntity: OptionVoiture::class)]
    private Collection $optionVoitures;

    public function __construct()
    {
        $this->optionVoitures = new ArrayCollection();
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

    /**
     * @return Collection<int, OptionVoiture>
     */
    public function getOptionVoitures(): Collection
    {
        return $this->optionVoitures;
    }

    public function addOptionVoiture(OptionVoiture $optionVoiture): self
    {
        if (!$this->optionVoitures->contains($optionVoiture)) {
            $this->optionVoitures->add($optionVoiture);
            $optionVoiture->setIDoption($this);
        }

        return $this;
    }

    public function removeOptionVoiture(OptionVoiture $optionVoiture): self
    {
        if ($this->optionVoitures->removeElement($optionVoiture)) {
            // set the owning side to null (unless already changed)
            if ($optionVoiture->getIDoption() === $this) {
                $optionVoiture->setIDoption(null);
            }
        }

        return $this;
    }
}
