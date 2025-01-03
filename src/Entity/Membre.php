<?php

namespace App\Entity;

use App\Repository\MembreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: MembreRepository::class)]
class Membre implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(length: 255)]
    private ?string $tel = null;

    #[ORM\Column]
    private ?bool $isverified = false;

    #[ORM\Column(options:['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $createdAt;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $birthday = null;

    #[ORM\OneToOne(mappedBy: 'membre', cascade: ['persist', 'remove'])]
    private ?Carte $carte = null;

    #[ORM\Column(length: 255)]
    private ?string $modePaiement = null;

    #[ORM\Column(length: 255)]
    private ?string $referalCode = null;

    #[ORM\ManyToOne(inversedBy: 'parrain', targetEntity: self::class, cascade: ['persist', 'remove'])]
    private ?self $parrain = null;

    #[ORM\OneToMany(mappedBy: 'membre', targetEntity: Frequentation::class)]
    private Collection $frequentations;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->frequentations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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

    public function isIsverified(): ?bool
    {
        return $this->isverified;
    }

    public function setIsverified(bool $isverified): self
    {
        $this->isverified = $isverified;

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getCarte(): ?Carte
    {
        return $this->carte;
    }

    public function setCarte(Carte $carte): self
    {
        // set the owning side of the relation if necessary
        if ($carte->getMembre() !== $this) {
            $carte->setMembre($this);
        }

        $this->carte = $carte;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->modePaiement;
    }

    public function setModePaiement(string $modePaiement): self
    {
        $this->modePaiement = $modePaiement;

        return $this;
    }

     //Pour mapper avec carte dans le backoffice
     public function __toString()
     {
         return $this->getFirstname().' '.$this->getLastname();
     }
     // Fin de mapping

     public function getReferalCode(): ?string
     {
         return $this->referalCode;
     }

     public function setReferalCode(string $referalCode): self
     {
         $this->referalCode = $referalCode;

         return $this;
     }

     public function getParrain(): ?self
     {
         return $this->parrain;
     }

     public function setParrain(?self $parrain): self
     {
         $this->parrain = $parrain;

         return $this;
     }

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
             $frequentation->setMembre($this);
         }

         return $this;
     }

     public function removeFrequentation(Frequentation $frequentation): self
     {
         if ($this->frequentations->removeElement($frequentation)) {
             // set the owning side to null (unless already changed)
             if ($frequentation->getMembre() === $this) {
                 $frequentation->setMembre(null);
             }
         }

         return $this;
     }

}
