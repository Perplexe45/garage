<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\Column(length: 300)]
    private ?string $caracteristique = null;

    #[ORM\Column]
    private ?int $kilometre = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employe $IDemploye = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?GallerieImage $IDgallerie_image = null;

    #[ORM\OneToMany(mappedBy: 'IDvoiture', targetEntity: Realiser::class)]
    private Collection $realisers;

    #[ORM\OneToMany(mappedBy: 'IDvoiture', targetEntity: EquipementVoiture::class)]
    private Collection $equipementVoitures;

    #[ORM\OneToMany(mappedBy: 'IDvoiture', targetEntity: OptionVoiture::class)]
    private Collection $optionVoitures;

    #[ORM\Column(nullable: true)]
    private ?bool $vendu = null;

    #[ORM\Column(length: 100)]
    private ?string $reference = null;

    #[ORM\OneToMany(mappedBy: 'IDvoiture', targetEntity: Contact::class)]
    private Collection $contacts;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $IDmarque = null;

    #[ORM\ManyToOne(inversedBy: 'voitures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Modele $IDmodele = null;

    #[ORM\Column]
    private ?int $circulation = null;

    #[ORM\Column]
    private ?int $prix = null;

    public function __construct()
    {
        $this->realisers = new ArrayCollection();
        $this->equipementVoitures = new ArrayCollection();
        $this->optionVoitures = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;
        
        return $this;
    }

  

    public function __toString()   
    {
        return $this->getReference();
    }

    public function getKilometre(): ?int
    {
        return $this->kilometre;
    }

    public function setKilometre(int $kilometre): self
    {
        $this->kilometre = $kilometre;

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

    public function getIDgallerieImage(): ?GallerieImage
    {
        return $this->IDgallerie_image;
    }

    public function setIDgallerieImage(?GallerieImage $IDgallerie_image): self
    {
        $this->IDgallerie_image = $IDgallerie_image;

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
            $realiser->setIDvoiture($this);
        }

        return $this;
    }

    public function removeRealiser(Realiser $realiser): self
    {
        if ($this->realisers->removeElement($realiser)) {
            // set the owning side to null (unless already changed)
            if ($realiser->getIDvoiture() === $this) {
                $realiser->setIDvoiture(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, EquipementVoiture>
     */
    public function getEquipementVoitures(): Collection
    {
        return $this->equipementVoitures;
    }

    public function addEquipementVoiture(EquipementVoiture $equipementVoiture): self
    {
        if (!$this->equipementVoitures->contains($equipementVoiture)) {
            $this->equipementVoitures->add($equipementVoiture);
            $equipementVoiture->setIDvoiture($this);
        }

        return $this;
    }

    public function removeEquipementVoiture(EquipementVoiture $equipementVoiture): self
    {
        if ($this->equipementVoitures->removeElement($equipementVoiture)) {
            // set the owning side to null (unless already changed)
            if ($equipementVoiture->getIDvoiture() === $this) {
                $equipementVoiture->setIDvoiture(null);
            }
        }

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
            $optionVoiture->setIDvoiture($this);
        }

        return $this;
    }

    public function removeOptionVoiture(OptionVoiture $optionVoiture): self
    {
        if ($this->optionVoitures->removeElement($optionVoiture)) {
            // set the owning side to null (unless already changed)
            if ($optionVoiture->getIDvoiture() === $this) {
                $optionVoiture->setIDvoiture(null);
            }
        }

        return $this;
    }

    public function isVendu(): ?bool
    {
        return $this->vendu;
    }

    public function setVendu(?bool $vendu): self
    {
        $this->vendu = $vendu;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getCaracteristique(): ?string
    {
        return $this->caracteristique;
    }

    public function setCaracteristique(string $caracteristique): self
    {
        $this->caracteristique = $caracteristique;

        return $this;
    }

    /**
     * @return Collection<int, Contact>
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts->add($contact);
            $contact->setIDvoiture($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getIDvoiture() === $this) {
                $contact->setIDvoiture(null);
            }
        }

        return $this;
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

    public function getIDmodele(): ?Modele
    {
        return $this->IDmodele;
    }

    public function setIDmodele(?Modele $IDmodele): self
    {
        $this->IDmodele = $IDmodele;

        return $this;
    }

    public function getCirculation(): ?int
    {
        return $this->circulation;
    }

    public function setCirculation(int $circulation): self
    {
        $this->circulation = $circulation;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }
}
