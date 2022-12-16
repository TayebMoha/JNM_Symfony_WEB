<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $lien = null;

    #[ORM\Column(length: 60)]
    private ?string $miage = null;

    #[ORM\Column(nullable: true)]
    private ?int $score = null;

    #[ORM\OneToMany(mappedBy: 'refVideo', targetEntity: Utilisateur::class)]
    private Collection $refUtilisateurs;

    public function __construct()
    {
        $this->refUtilisateurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getMiage(): ?string
    {
        return $this->miage;
    }

    public function setMiage(string $miage): self
    {
        $this->miage = $miage;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(?int $score): self
    {
        $this->score = $score;

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
            $refUtilisateur->setRefVideo($this);
        }

        return $this;
    }

    public function removeRefUtilisateur(Utilisateur $refUtilisateur): self
    {
        if ($this->refUtilisateurs->removeElement($refUtilisateur)) {
            // set the owning side to null (unless already changed)
            if ($refUtilisateur->getRefVideo() === $this) {
                $refUtilisateur->setRefVideo(null);
            }
        }

        return $this;
    }
}
