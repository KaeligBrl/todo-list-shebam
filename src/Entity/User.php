<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(
 * fields= {"email"},
 * message= "L'email que vous avez entrée est déjà utilisé !"
 * )
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\ManyToMany(targetEntity=Task::class, mappedBy="users")
     */
    private $tasks;

    /**
     * @ORM\OneToMany(targetEntity=Rendezvous::class, mappedBy="utilisateur")
     */
    private $rendezvouses;

    /**
     * @ORM\ManyToMany(targetEntity=Quote::class, mappedBy="person")
     */
    private $quotes;

    /**
     * @ORM\ManyToMany(targetEntity=Task2::class, mappedBy="users")
     */
    private $task2s;

    public function __construct()
    {
        $this->tasks = new ArrayCollection();
        $this->rendezvouses = new ArrayCollection();
        $this->quotes = new ArrayCollection();
        $this->task2s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

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
            $tas->addUser($this);
        }

        return $this;
    }

    public function removeTach(Task $tas): self
    {
        if ($this->tasks->removeElement($tas)) {
            $tas->removeUser($this);
        }

        return $this;
    }

    public function __toString()
    {
    return $this->firstname;
    }

    /**
     * @return Collection|Rendezvous[]
     */
    public function getRendezvouses(): Collection
    {
        return $this->rendezvouses;
    }

    public function addRendezvouse(Rendezvous $rendezvouse): self
    {
        if (!$this->rendezvouses->contains($rendezvouse)) {
            $this->rendezvouses[] = $rendezvouse;
            $rendezvouse->setUtilisateur($this);
        }

        return $this;
    }

    public function removeRendezvouse(Rendezvous $rendezvouse): self
    {
        if ($this->rendezvouses->removeElement($rendezvouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezvouse->getUtilisateur() === $this) {
                $rendezvouse->setUtilisateur(null);
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
            $quote->addPerson($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->removeElement($quote)) {
            $quote->removePerson($this);
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
            $task2->addUser($this);
        }

        return $this;
    }

    public function removeTask2(Task2 $task2): self
    {
        if ($this->task2s->removeElement($task2)) {
            $task2->removeUser($this);
        }

        return $this;
    }
}