<?php

namespace App\Entity;

use App\Repository\OptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionsRepository::class)]
class Options
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'IDoptions', targetEntity: OptionVoiture::class)]
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

    public function __toString()    //Il faut renvoyer un "get' ou la propriété déclaré est un "String", mais un 'get gégnéré dans la classe 'Options'
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, OptionVoiture>
     */
    public function getOptionVoitures(): Collection
    {
        return $this->optionVoitures;
    }

     /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $selectedOptions;

    // ...

    public function getSelectedOptions(): ?array
    {
        return $this->selectedOptions;
    }

    public function setSelectedOptions(?array $selectedOptions): self
    {
        $this->selectedOptions = $selectedOptions;

        return $this;
    }


    public function addOptionVoiture(OptionVoiture $optionVoiture): self
    {
        if (!$this->optionVoitures->contains($optionVoiture)) {
            $this->optionVoitures->add($optionVoiture);
            $optionVoiture->setIDoptions($this);
        }

        return $this;
    }

    public function removeOptionVoiture(OptionVoiture $optionVoiture): self
    {
        if ($this->optionVoitures->removeElement($optionVoiture)) {
            // set the owning side to null (unless already changed)
            if ($optionVoiture->getIDoptions() === $this) {
                $optionVoiture->setIDoptions(null);
            }
        }

        return $this;
    }
}
