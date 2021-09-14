<?php

namespace App\Entity;

use App\Repository\ChangelogRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ChangelogRepository::class)
 */
class Changelog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $version;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subname2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subname3;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
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

    public function getSubname(): ?string
    {
        return $this->subname;
    }

    public function setSubname(string $subname): self
    {
        $this->subname = $subname;

        return $this;
    }

    public function getSubname2(): ?string
    {
        return $this->subname2;
    }

    public function setSubname2(?string $subname2): self
    {
        $this->subname2 = $subname2;

        return $this;
    }

    public function getSubname3(): ?string
    {
        return $this->subname3;
    }

    public function setSubname3(?string $subname3): self
    {
        $this->subname3 = $subname3;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime());
    }
}
