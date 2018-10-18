<?php

// le fichier se trouve dans src/Security/AccessChecker.php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entie;


class AccessChecker
{
    private $user;

    // injecter l'user connecté dans le service ou d'autres services
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->user = $tokenStorage->getToken()->getUser();
        dump($this->user);
    }


    public function canReadHomepage(): bool
    {
        if ($this->user) {
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
