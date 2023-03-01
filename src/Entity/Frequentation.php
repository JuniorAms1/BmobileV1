<?php

namespace App\Entity;

use App\Repository\FrequentationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrequentationRepository::class)]
class Frequentation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $dateFreq = null;

    #[ORM\Column]
    private ?float $montant = null;

    #[ORM\Column(length: 255)]
    private ?int $membre = null;

    #[ORM\Column(length: 255)]
    private ?int $structure = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFreq(): ?\DateTimeImmutable
    {
        return $this->dateFreq;
    }

    public function setDateFreq(\DateTimeImmutable $dateFreq): self
    {
        $this->dateFreq = $dateFreq;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getMembre(): ?string
    {
        return $this->membre;
    }

    public function setMembre(string $membre): self
    {
        $this->membre = $membre;

        return $this;
    }

    public function getStructure(): ?string
    {
        return $this->structure;
    }

    public function setStructure(string $structure): self
    {
        $this->structure = $structure;

        return $this;
    }

   
}
