<?php

// le fichier se trouve dans src/Security/AccessChecker.php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\User;
use App\Entity\Incubator;


class AccessChecker
{
    private $user;

    // injecter l'user connecté dans le service ou d'autres services
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
    }

    public function getUser() : User
    {
        if ($this->user && $this->user != "anon.")
        {
            return $this->user;
        }
        return null;
    }

    public function isConnected(): bool
    {
        if ($this->user && $this->user != "anon.") {
            return true;
        }

        return false;
    }

    public function canReadHomepage(): bool
    {
        if ($this->user && $this->user != "anon.") {
            return true;
        }

        return false;
    }

    public function canReadIncub(Incubator $incub): bool
    {
        if ($incub->getIsPublic())
        {
            return true;
        }
        elseif ($this->user && $this->user != "anon.")
        {
            if ($this->user->getProject()->getIncubator()->getId() == $incub->getId())
            {
                return true;
            };
        }
        return false;
    }

    public function canReadProject(Project $project): bool
    {
        if ($project->getIsPublic())
        {
            return true;
        }
        elseif ($this->user && $this->user != "anon.")
        {
            if ($this->user->getProject()->getId() == $project->getId())
            {
                return true;
            };
        }
        return false;
    }

    public function canReadProfil(User $profil): bool
    {
        if ($profil->getIsPublic())
        {
            return true;
        }
        elseif ($this->user && $this->user != "anon.")
        {
            if ($this->user->getId() == $profil->getId())
            {
                return true;
            };
        }
        return false;
    }
}
