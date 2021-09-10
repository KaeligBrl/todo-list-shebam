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
    private $object;
    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="task2s")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="task2")
     */
    private $customer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sub_object1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sub_object2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sub_object3;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $archived;

    /**
     * @ORM\Column(type="integer", nullable=true)
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

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return Collection|Status[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
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

    public function getSubObject1(): ?string
    {
        return $this->sub_object1;
    }

    public function setSubObject1(?string $sub_object1): self
    {
        $this->sub_object1 = $sub_object1;

        return $this;
    }

    public function getSubObject2(): ?string
    {
        return $this->sub_object2;
    }

    public function setSubObject2(?string $sub_object2): self
    {
        $this->sub_object2 = $sub_object2;

        return $this;
    }

    public function getSubObject3(): ?string
    {
        return $this->sub_object3;
    }

    public function setSubObject3(?string $sub_object3): self
    {
        $this->sub_object3 = $sub_object3;

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
        return $this->poisition;
    }

    public function setPosition(?int $poisition): self
    {
        $this->poisition = $poisition;

        return $this;
    }
}
