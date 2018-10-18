<?php

// le fichier se trouve dans src/Security/AccessChecker.php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\User;


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

    public function canReadIncub(Incub $incub): bool
    {
        //faire des trucs ici
        return true;
    }

    public function canReadProfile(User $user): bool
    {
        //faire des trucs ici
        return true;
    }
}
