<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $links = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $cover;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pyoupyou", mappedBy="project")
     */
    private $pyoupyous;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublic = false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Incubator", inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $incubator;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="project")
     */
    private $users;

    public function __construct()
    {
        $this->pyoupyous = new ArrayCollection();
        $this->users = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLinks(): ?array
    {
        return $this->links;
    }

    public function setLinks(?array $links): self
    {
        $this->links = $links;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }


    /**
     * @return Collection|Pyoupyou[]
     */
    public function getPyoupyous(): Collection
    {
        return $this->pyoupyous;
    }

    public function addPyoupyou(Pyoupyou $pyoupyou): self
    {
        if (!$this->pyoupyous->contains($pyoupyou)) {
            $this->pyoupyous[] = $pyoupyou;
            $pyoupyou->setProject($this);
        }

        return $this;
    }

    public function removePyoupyou(Pyoupyou $pyoupyou): self
    {
        if ($this->pyoupyous->contains($pyoupyou)) {
            $this->pyoupyous->removeElement($pyoupyou);
            // set the owning side to null (unless already changed)
            if ($pyoupyou->getProject() === $this) {
                $pyoupyou->setProject(null);
            }
        }

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getIncubator(): ?Incubator
    {
        return $this->incubator;
    }

    public function setIncubator(?Incubator $incubator): self
    {
        $this->incubator = $incubator;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setProject($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
            // set the owning side to null (unless already changed)
            if ($user->getProject() === $this) {
                $user->setProject(null);
            }
        }

        return $this;
    }
}
