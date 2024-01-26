<?php

namespace App\Entity;

use App\Repository\EnseigneDetailsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseigneDetailsRepository::class)]
class EnseigneDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstIllustration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $secondIllustration = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thirdIllustration = null;

    #[ORM\Column(length: 255)]
    private ?string $catalogue = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $siteweb = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $mapLocalisation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rsInsta = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rsFacebook = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $rsTwitter = null;

    #[ORM\Column(length: 255)]
    private ?string $whatsapp = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $aPropos = null;

    #[ORM\OneToOne(inversedBy: 'enseigneDetails', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Enseigne $enseigne = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstIllustration(): ?string
    {
        return $this->firstIllustration;
    }

    public function setFirstIllustration(string $firstIllustration): self
    {
        $this->firstIllustration = $firstIllustration;

        return $this;
    }

    public function getSecondIllustration(): ?string
    {
        return $this->secondIllustration;
    }

    public function setSecondIllustration(?string $secondIllustration): self
    {
        $this->secondIllustration = $secondIllustration;

        return $this;
    }

    public function getThirdIllustration(): ?string
    {
        return $this->thirdIllustration;
    }

    public function setThirdIllustration(?string $thirdIllustration): self
    {
        $this->thirdIllustration = $thirdIllustration;

        return $this;
    }

    public function getCatalogue(): ?string
    {
        return $this->catalogue;
    }

    public function setCatalogue(string $catalogue): self
    {
        $this->catalogue = $catalogue;

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

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(?string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    public function getMapLocalisation(): ?string
    {
        return $this->mapLocalisation;
    }

    public function setMapLocalisation(string $mapLocalisation): self
    {
        $this->mapLocalisation = $mapLocalisation;

        return $this;
    }

    public function getRsInsta(): ?string
    {
        return $this->rsInsta;
    }

    public function setRsInsta(?string $rsInsta): self
    {
        $this->rsInsta = $rsInsta;

        return $this;
    }

    public function getRsFacebook(): ?string
    {
        return $this->rsFacebook;
    }

    public function setRsFacebook(?string $rsFacebook): self
    {
        $this->rsFacebook = $rsFacebook;

        return $this;
    }

    public function getRsTwitter(): ?string
    {
        return $this->rsTwitter;
    }

    public function setRsTwitter(?string $rsTwitter): self
    {
        $this->rsTwitter = $rsTwitter;

        return $this;
    }

    public function getWhatsapp(): ?string
    {
        return $this->whatsapp;
    }

    public function setWhatsapp(string $whatsapp): self
    {
        $this->whatsapp = $whatsapp;

        return $this;
    }

    public function getAPropos(): ?string
    {
        return $this->aPropos;
    }

    public function setAPropos(string $aPropos): self
    {
        $this->aPropos = $aPropos;

        return $this;
    }

    public function getEnseigne(): ?Enseigne
    {
        return $this->enseigne;
    }

    public function setEnseigne(Enseigne $enseigne): self
    {
        $this->enseigne = $enseigne;

        return $this;
    }
}
