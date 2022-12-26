<?php

namespace App\Entity;

use App\Repository\LogementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogementRepository::class)]
class Logement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $typeL = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column(length: 60)]
    private ?string $ville = null;

    #[ORM\OneToMany(mappedBy: 'refLogement', targetEntity: Utilisateur::class)]
    private Collection $refUtilisateur;

    public function __construct()
    {
        $this->refUtilisateur = new ArrayCollection();
    }

    public function __toString() : string
    {
        return $this->getVille();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeL(): ?string
    {
        return $this->typeL;
    }

    public function setTypeL(string $typeL): self
    {
        $this->typeL = $typeL;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

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
            $refUtilisateur->setRefLogement($this);
        }

        return $this;
    }

    public function removeRefUtilisateur(Utilisateur $refUtilisateur): self
    {
        if ($this->refUtilisateur->removeElement($refUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($refUtilisateur->getRefLogement() === $this) {
                $refUtilisateur->setRefLogement(null);
            }
        }

        return $this;
    }
}
