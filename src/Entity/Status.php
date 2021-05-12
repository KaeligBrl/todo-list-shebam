<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatusRepository::class)
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=Tache::class, mappedBy="status")
     */
    private $taches;

    /**
     * @ORM\OneToMany(targetEntity=Quote::class, mappedBy="status")
     */
    private $quotes;

    /**
     * @ORM\OneToMany(targetEntity=Task2::class, mappedBy="status")
     */
    private $task2s;

    public function __construct()
    {
        $this->tache = new ArrayCollection();
        $this->taches = new ArrayCollection();
        $this->quotes = new ArrayCollection();
        $this->task2s = new ArrayCollection();
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

    public function __toString()
    {
    return $this->name;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTache(): Collection
    {
        return $this->tache;
    }

    public function addTache(Tache $tache): self
    {
        if (!$this->tache->contains($tache)) {
            $this->tache[] = $tache;
            $tache->setStatus($this);
        }

        return $this;
    }

    public function removeTache(Tache $tache): self
    {
        if ($this->tache->removeElement($tache)) {
            // set the owning side to null (unless already changed)
            if ($tache->getStatus() === $this) {
                $tache->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Tache[]
     */
    public function getTaches(): Collection
    {
        return $this->taches;
    }

    public function addTach(Tache $tach): self
    {
        if (!$this->taches->contains($tach)) {
            $this->taches[] = $tach;
            $tach->setStatus($this);
        }

        return $this;
    }

    public function removeTach(Tache $tach): self
    {
        if ($this->taches->removeElement($tach)) {
            // set the owning side to null (unless already changed)
            if ($tach->getStatus() === $this) {
                $tach->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Quote[]
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes[] = $quote;
            $quote->setStatus($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->removeElement($quote)) {
            // set the owning side to null (unless already changed)
            if ($quote->getStatus() === $this) {
                $quote->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Task2[]
     */
    public function getTask2s(): Collection
    {
        return $this->task2s;
    }

    public function addTask2(Task2 $task2): self
    {
        if (!$this->task2s->contains($task2)) {
            $this->task2s[] = $task2;
            $task2->setStatus($this);
        }

        return $this;
    }

    public function removeTask2(Task2 $task2): self
    {
        if ($this->task2s->removeElement($task2)) {
            // set the owning side to null (unless already changed)
            if ($task2->getStatus() === $this) {
                $task2->setStatus(null);
            }
        }

        return $this;
    }

}