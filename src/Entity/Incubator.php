<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IncubatorRepository")
 */
class Incubator
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Project", mappedBy="incubator", orphanRemoval=true)
     */
    private $projects;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublic;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pyoupyou", mappedBy="incubator")
     */
    private $pyoupyous;


    public function __construct()
    {
        $this->projects = new ArrayCollection();
        $this->pyoupyous = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Project[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setIncubator($this);
        }

        return $this;
    }

    public function removeProject(Project $project): self
    {
        if ($this->projects->contains($project)) {
            $this->projects->removeElement($project);
            // set the owning side to null (unless already changed)
            if ($project->getIncubator() === $this) {
                $project->setIncubator(null);
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
            $pyoupyou->setIncubator($this);
        }

        return $this;
    }

    public function removePyoupyou(Pyoupyou $pyoupyou): self
    {
        if ($this->pyoupyous->contains($pyoupyou)) {
            $this->pyoupyous->removeElement($pyoupyou);
            // set the owning side to null (unless already changed)
            if ($pyoupyou->getIncubator() === $this) {
                $pyoupyou->setIncubator(null);
            }
        }

        return $this;
    }
}
