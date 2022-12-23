<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
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

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $dateNaissance = null;

    #[ORM\Column(length: 50)]
    private ?string $provenance = null;

    #[ORM\Column(length: 70)]
    private ?string $adresse = null;

    #[ORM\Column(length: 50)]
    private ?string $numTel = null;

    #[ORM\ManyToOne(inversedBy: 'refUtilisateurs')]
    private ?Video $refVideo = null;

    #[ORM\ManyToOne(inversedBy: 'refUtilisateur')]
    private ?Logement $refLogement = null;

    #[ORM\ManyToOne(inversedBy: 'refUtilisateurs')]
    private ?Navigo $refNavigo = null;

    #[ORM\ManyToMany(targetEntity: Activite::class, inversedBy: 'refUtilisateur')]
    private Collection $refActivite;

    #[ORM\ManyToMany(targetEntity: Statut::class, inversedBy: 'refUtilisateur')]
    private Collection $refStatut;

    #[ORM\Column(type: 'boolean')]
    private $isVerified = false;

    public function __construct()
    {
        $this->refActivite = new ArrayCollection();
        $this->refStatut = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateNaissance(): ?string
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(string $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getProvenance(): ?string
    {
        return $this->provenance;
    }

    public function setProvenance(string $provenance): self
    {
        $this->provenance = $provenance;

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

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getRefVideo(): ?Video
    {
        return $this->refVideo;
    }

    public function setRefVideo(?Video $refVideo): self
    {
        $this->refVideo = $refVideo;

        return $this;
    }

    public function getRefLogement(): ?Logement
    {
        return $this->refLogement;
    }

    public function setRefLogement(?Logement $refLogement): self
    {
        $this->refLogement = $refLogement;

        return $this;
    }

    public function getRefNavigo(): ?Navigo
    {
        return $this->refNavigo;
    }

    public function setRefNavigo(?Navigo $refNavigo): self
    {
        $this->refNavigo = $refNavigo;

        return $this;
    }

    /**
     * @return Collection<int, Activite>
     */
    public function getRefActivite(): Collection
    {
        return $this->refActivite;
    }

    public function addRefActivite(Activite $refActivite): self
    {
        if (!$this->refActivite->contains($refActivite)) {
            $this->refActivite->add($refActivite);
        }

        return $this;
    }

    public function removeRefActivite(Activite $refActivite): self
    {
        $this->refActivite->removeElement($refActivite);

        return $this;
    }

    /**
     * @return Collection<int, Statut>
     */
    public function getRefStatut(): Collection
    {
        return $this->refStatut;
    }

    public function addRefStatut(Statut $refStatut): self
    {
        if (!$this->refStatut->contains($refStatut)) {
            $this->refStatut->add($refStatut);
        }

        return $this;
    }

    public function removeRefStatut(Statut $refStatut): self
    {
        $this->refStatut->removeElement($refStatut);

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}
