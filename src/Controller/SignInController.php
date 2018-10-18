<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SignInController extends AbstractController
{
    /**
    * @Route("/SignIn", name="signin")
    */
    public function signin(AuthenticationUtils $authenticationUtils)
    {

        // get the signin error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/signin.html.twig', [
            'title' => 'Connexion',
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}
