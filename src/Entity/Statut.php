<?php

namespace App\Entity;

use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $categoriesS = null;

    #[ORM\ManyToMany(targetEntity: Utilisateur::class, mappedBy: 'refStatut')]
    private Collection $refUtilisateur;

    public function __construct()
    {
        $this->refUtilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoriesS(): ?string
    {
        return $this->categoriesS;
    }

    public function setCategoriesS(string $categoriesS): self
    {
        $this->categoriesS = $categoriesS;

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
            $refUtilisateur->addRefStatut($this);
        }

        return $this;
    }

    public function removeRefUtilisateur(Utilisateur $refUtilisateur): self
    {
        if ($this->refUtilisateur->removeElement($refUtilisateur)) {
            $refUtilisateur->removeRefStatut($this);
        }

        return $this;
    }
}
