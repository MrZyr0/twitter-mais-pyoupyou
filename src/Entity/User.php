<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

// TODO: Check chaque propriété pour qu'ils puissent être null au moment de l'inscription OU mettre une valeur par defaut && mettre un S à STATUS !!!!! + mettre une propriété isActive


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez obligatoirement remplir ce champ !"
     * )
     * @Assert\Email(
     *     message = "Ce n'est pas une adresse email valide !",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez obligatoirement remplir ce champ !"
     * )
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez obligatoirement remplir ce champ !"
     * )
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z0-9\w+\|]+$/",
     *     match=false,
     *     message = "Votre mot de passe doit être composé de : 2 MAJ + 2 min + 2 caractères spéciaux"
     * )
     * @Assert\Length(
     *      min = 8,
     *      minMessage = "Votre mot de passe doit faire 8 charactères minimum !",
     * )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez obligatoirement remplir ce champ !"
     * )
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *  message = "Vous devez obligatoirement remplir ce champ !"
     * )
     */
    private $firstname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $cover;

    /**
     * @ORM\Column(type="simple_array", nullable=true)
     */
    private $links = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $role = "ROLE_USER";

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $statut = 'user';


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pyoupyou", mappedBy="user", orphanRemoval=true)
     */
    private $pyoupyous;


    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Pyoupyou", cascade={"persist", "remove"})
     */
    private $pinPyoupyou;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublic = false;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="users")
     */
    private $project;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive = true;

    public function __construct()
    {
        $this->pyoupyous = new ArrayCollection();
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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

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

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

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

    public function getLinks(): ?array
    {
        return $this->links;
    }

    public function setLinks(?array $links): self
    {
        $this->links = $links;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): self
    {
        $this->statut = $statut;

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
            $pyoupyou->setUser($this);
        }

        return $this;
    }

    public function removePyoupyou(Pyoupyou $pyoupyou): self
    {
        if ($this->pyoupyous->contains($pyoupyou)) {
            $this->pyoupyous->removeElement($pyoupyou);
            // set the owning side to null (unless already changed)
            if ($pyoupyou->getUser() === $this) {
                $pyoupyou->setUser(null);
            }
        }

        return $this;
    }


    public function getPinPyoupyou(): ?Pyoupyou
    {
        return $this->pinPyoupyou;
    }

    public function setPinPyoupyou(?Pyoupyou $pinPyoupyou): self
    {
        $this->pinPyoupyou = $pinPyoupyou;

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

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }



    public function getRoles(): ?array
    {
        return [$this->getRole()];
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized, array('allowed_classes' => false));
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
