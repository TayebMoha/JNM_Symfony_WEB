<?php

namespace App\Entity;

use App\Repository\NavigoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NavigoRepository::class)]
class Navigo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbjours = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\OneToMany(mappedBy: 'refNavigo', targetEntity: Utilisateur::class)]
    private Collection $refUtilisateurs;

    public function __construct()
    {
        $this->refUtilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbjours(): ?int
    {
        return $this->nbjours;
    }

    public function setNbjours(int $nbjours): self
    {
        $this->nbjours = $nbjours;

        return $this;
    }

    public function __toString() : string
    {
        return 'Formule '.$this->getId().' : '.$this->getNbjours().' jours '.($this->getPrix()).'€';
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

    /**
     * @return Collection<int, Utilisateur>
     */
    public function getRefUtilisateurs(): Collection
    {
        return $this->refUtilisateurs;
    }

    public function addRefUtilisateur(Utilisateur $refUtilisateur): self
    {
        if (!$this->refUtilisateurs->contains($refUtilisateur)) {
            $this->refUtilisateurs->add($refUtilisateur);
            $refUtilisateur->setRefNavigo($this);
        }

        return $this;
    }

    public function removeRefUtilisateur(Utilisateur $refUtilisateur): self
    {
        if ($this->refUtilisateurs->removeElement($refUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($refUtilisateur->getRefNavigo() === $this) {
                $refUtilisateur->setRefNavigo(null);
            }
        }

        return $this;
    }
}
