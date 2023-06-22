<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GallerieImageRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;



#[ORM\Entity(repositoryClass: GallerieImageRepository::class)]
class GallerieImage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img4 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img5 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img6 = null;

    #[ORM\OneToMany(mappedBy: 'IDgallerie_image', targetEntity: Voiture::class)]
    private Collection $voitures;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __toString()    //Il faut renvoyer un "get' ou la propriété déclaré est un "String", mais un 'get gégnéré dans la classe
    {
        return $this->getNom();
    }

    public function getImg1(): ?string
    {
        return $this->img1;
    }

    public function setImg1(?string $img1): self
    {
        $this->img1 = $img1;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img2;
    }

    public function setImg2(?string $img2): self
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img3;
    }

    public function setImg3(?string $img3): self
    {
        $this->img3 = $img3;

        return $this;
    }

    public function getImg4(): ?string
    {
        return $this->img4;
    }

    public function setImg4(?string $img4): self
    {
        $this->img4 = $img4;

        return $this;
    }

    public function getImg5(): ?string
    {
        return $this->img5;
    }

    public function setImg5(?string $img5): self
    {
        $this->img5 = $img5;

        return $this;
    }

    public function getImg6(): ?string
    {
        return $this->img6;
    }

    public function setImg6(?string $img6): self
    {
        $this->img6 = $img6;

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
            $voiture->setIDgallerieImage($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getIDgallerieImage() === $this) {
                $voiture->setIDgallerieImage(null);
            }
        }

        return $this;
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
}
