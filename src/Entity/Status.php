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
     * @ORM\OneToMany(targetEntity=Task::class, mappedBy="status")
     */
    private $tasks;

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
        $this->task = new ArrayCollection();
        $this->tasks = new ArrayCollection();
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
     * @return Collection|Task[]
     */
    public function getTache(): Collection
    {
        return $this->task;
    }

    public function addTache(Task $task): self
    {
        if (!$this->task->contains($task)) {
            $this->task[] = $task;
            $task->setStatus($this);
        }

        return $this;
    }

    public function removeTache(Task $task): self
    {
        if ($this->task->removeElement($task)) {
            // set the owning side to null (unless already changed)
            if ($task->getStatus() === $this) {
                $task->setStatus(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Task[]
     */
    public function getTaches(): Collection
    {
        return $this->tasks;
    }

    public function addTach(Task $tas): self
    {
        if (!$this->tasks->contains($tas)) {
            $this->tasks[] = $tas;
            $tas->setStatus($this);
        }

        return $this;
    }

    public function removeTach(Task $tas): self
    {
        if ($this->tasks->removeElement($tas)) {
            // set the owning side to null (unless already changed)
            if ($tas->getStatus() === $this) {
                $tas->setStatus(null);
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