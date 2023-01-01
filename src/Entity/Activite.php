<?php

namespace App\Entity;

use App\Repository\ActiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActiviteRepository::class)]
class Activite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $categorie = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'refActivite')]
    private Collection $refUtilisateur;

    public function __construct()
    {
        $this->refUtilisateur = new ArrayCollection();
    }

    public function __toString() : string
    {
        return $this->getCategorie();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(string $categorie): self
    {
        $this->categorie = $categorie;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getRefUtilisateur(): Collection
    {
        return $this->refUtilisateur;
    }

    public function addRefUtilisateur(Utilisateur $refUtilisateur): self
    {
        if (!$this->refUtilisateur->contains($refUtilisateur)) {
            $this->refUtilisateur->add($refUtilisateur);
            $refUtilisateur->setRefActivite($this);
        }

        return $this;
    }

    public function removeRefUtilisateur(Utilisateur $refUtilisateur): self
    {
        if ($this->refUtilisateur->removeElement($refUtilisateur)) {
            if ($refUtilisateur->getRefActivite() === $this) {
                $refUtilisateur->setRefActivite(null);
            }
        }

        return $this;
    }
}
