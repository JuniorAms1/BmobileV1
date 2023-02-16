<?php

namespace App\Entity;

use App\Repository\EnseigneRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseigneRepository::class)]
class Enseigne
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?float $remise = null;

    #[ORM\Column(nullable: true)]
    private ?float $prixPublic = null;

    #[ORM\ManyToOne(inversedBy: 'enseignes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categories $categorie = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToOne(mappedBy: 'enseigne', cascade: ['persist', 'remove'])]
    private ?EnseigneDetails $enseigneDetails = null;
    
    #[ORM\Column(options:['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column]
    private ?bool $isBest = null;

    #[ORM\OneToMany(mappedBy: 'enseigne', targetEntity: Structure::class)]
    private Collection $structures;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->structures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): self
    {
        $this->logo = $logo;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getRemise(): ?float
    {
        return $this->remise;
    }

    public function setRemise(float $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getPrixPublic(): ?float
    {
        return $this->prixPublic;
    }

    public function setPrixPublic(?float $prixPublic): self
    {
        $this->prixPublic = $prixPublic;

        return $this;
    }

    public function getCategorie(): ?Categories
    {
        return $this->categorie;
    }

    public function setCategorie(?Categories $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

      //Pour mapper Enseignes et EnseigneDetails dans le backoffice
      public function __toString()
      {
          return $this->getNom();
      }
      // Fin de mapping
    public function getEnseigneDetails(): ?EnseigneDetails
    {
        return $this->enseigneDetails;
    }

    public function setEnseigneDetails(EnseigneDetails $enseigneDetails): self
    {
        // set the owning side of the relation if necessary
        if ($enseigneDetails->getEnseigne() !== $this) {
            $enseigneDetails->setEnseigne($this);
        }

        $this->enseigneDetails = $enseigneDetails;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function isIsBest(): ?bool
    {
        return $this->isBest;
    }

    public function setIsBest(bool $isBest): self
    {
        $this->isBest = $isBest;

        return $this;
    }

    /**
     * @return Collection<int, Structure>
     */
    public function getStructures(): Collection
    {
        return $this->structures;
    }

    public function addStructure(Structure $structure): self
    {
        if (!$this->structures->contains($structure)) {
            $this->structures->add($structure);
            $structure->setEnseigne($this);
        }

        return $this;
    }

    public function removeStructure(Structure $structure): self
    {
        if ($this->structures->removeElement($structure)) {
            // set the owning side to null (unless already changed)
            if ($structure->getEnseigne() === $this) {
                $structure->setEnseigne(null);
            }
        }

        return $this;
    }
}
