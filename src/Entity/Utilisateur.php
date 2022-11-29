<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $identifiant = null;

    #[ORM\Column(length: 50)]
    private ?string $mdp = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    private ?string $prenom = null;

    #[ORM\Column(length: 10)]
    private ?string $dateNaissance = null;

    #[ORM\Column(length: 50)]
    private ?string $provenance = null;

    #[ORM\Column(length: 100)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $tel = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Video $refVideo = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Logement $refLogement = null;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    private ?Navigo $refNavigo = null;

    #[ORM\ManyToMany(targetEntity: Statut::class, inversedBy: 'utilisateurs')]
    private Collection $refStatut;

    #[ORM\ManyToMany(targetEntity: Activite::class, inversedBy: 'refUtilisateurs')]
    private Collection $refActivite;

    public function __construct()
    {
        $this->refStatut = new ArrayCollection();
        $this->refActivite = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

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

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

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
}
