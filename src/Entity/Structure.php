<?php

namespace App\Entity;

use App\Repository\StructureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructureRepository::class)]
class Structure
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enseigne $enseigne = null;

    #[ORM\OneToOne(mappedBy: 'structure', cascade: ['persist', 'remove'])]
    private ?Partner $partner = null;

    #[ORM\OneToMany(mappedBy: 'structure', targetEntity: Frequentation::class)]
    private Collection $frequentations;

    public function __construct()
    {
        $this->frequentations = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getEnseigne(): ?Enseigne
    {
        return $this->enseigne;
    }

    public function setEnseigne(?Enseigne $enseigne): self
    {
        $this->enseigne = $enseigne;

        return $this;
    }

    public function getPartner(): ?Partner
    {
        return $this->partner;
    }

    public function setPartner(Partner $partner): self
    {
        // set the owning side of the relation if necessary
        if ($partner->getStructure() !== $this) {
            $partner->setStructure($this);
        }

        $this->partner = $partner;

        return $this;
    }
         //Pour mapper Structure et Partner dans le backoffice
         public function __toString()
         {
             return $this->getNom();
         }
         // Fin de mapping

         /**
          * @return Collection<int, Frequentation>
          */
         public function getFrequentations(): Collection
         {
             return $this->frequentations;
         }

         public function addFrequentation(Frequentation $frequentation): self
         {
             if (!$this->frequentations->contains($frequentation)) {
                 $this->frequentations->add($frequentation);
                 $frequentation->setStructure($this);
             }

             return $this;
         }

         public function removeFrequentation(Frequentation $frequentation): self
         {
             if ($this->frequentations->removeElement($frequentation)) {
                 // set the owning side to null (unless already changed)
                 if ($frequentation->getStructure() === $this) {
                     $frequentation->setStructure(null);
                 }
             }

             return $this;
         }
}
