<?php

namespace App\Entity;

use App\Repository\RendezvousRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RendezvousRepository::class)
 */
class Rendezvous
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $sujet;
    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="rendezvouses")
     */
    private $statut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $heuredurendezvous;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="rendezvouses")
     */
    private $utilisateur;

    public function __construct()
    {
        $this->utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSujet(): ?string
    {
        return $this->sujet;
    }

    public function setSujet(string $sujet): self
    {
        $this->sujet = $sujet;

        return $this;
    }

    public function getStatut(): ?Status
    {
        return $this->statut;
    }

    public function setStatut(?Status $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getHeuredurendezvous(): ?\DateTimeInterface
    {
        return $this->heuredurendezvous;
    }

    public function setHeuredurendezvous(\DateTimeInterface $heuredurendezvous): self
    {
        $this->heuredurendezvous = $heuredurendezvous;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(User $utilisateur): self
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur[] = $utilisateur;
        }

        return $this;
    }

    public function removeUtilisateur(User $utilisateur): self
    {
        $this->utilisateur->removeElement($utilisateur);

        return $this;
    }
}