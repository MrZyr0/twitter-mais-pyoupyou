<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PyoupyouRepository")
 */
class Pyoupyou
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="pyoupyous")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="pyoupyous")
     */
    private $project;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublic =  false;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Incubator", inversedBy="pyoupyous")
     */
    private $incubator;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="reposts")
     */
    private $repostUsers;

    public function __construct()
    {
        $this->repostUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

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
    public function getRepostUsers(): Collection
    {
        return $this->repostUsers;
    }

    public function addRepostUser(User $repostUser): self
    {
        if (!$this->repostUsers->contains($repostUser)) {
            $this->repostUsers[] = $repostUser;
            $repostUser->addRepost($this);
        }

        return $this;
    }

    public function removeRepostUser(User $repostUser): self
    {
        if ($this->repostUsers->contains($repostUser)) {
            $this->repostUsers->removeElement($repostUser);
            $repostUser->removeRepost($this);
        }

        return $this;
    }
}
