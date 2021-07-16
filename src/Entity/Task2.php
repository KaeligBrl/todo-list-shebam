<?php

namespace App\Entity;

use App\Repository\Task2Repository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Task2Repository::class)
 */
class Task2
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
    private $subject;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="task2s")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="task2s")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="task2")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sub_subject1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sub_subject2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sub_subject3;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archived;

    /**
     * @ORM\Column(type="integer")
     */
    private $position;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Status $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
        }

        return $this;
    }

    public function removeUser(Status $user): self
    {
        $this->users->removeElement($user);

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getSubSubject1(): ?string
    {
        return $this->sub_subject1;
    }

    public function setSubSubject1(?string $sub_subject1): self
    {
        $this->sub_subject1 = $sub_subject1;

        return $this;
    }

    public function getSubSubject2(): ?string
    {
        return $this->sub_subject2;
    }

    public function setSubSubject2(?string $sub_subject2): self
    {
        $this->sub_subject2 = $sub_subject2;

        return $this;
    }

    public function getSubSubject3(): ?string
    {
        return $this->sub_subject3;
    }

    public function setSubSubject3(?string $sub_subject3): self
    {
        $this->sub_subject3 = $sub_subject3;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }
}
