<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(AuthorizationCheckerInterface $authorizationChecker)
    {
        if ($authorizationChecker->isGranted('ROLE_USER') && $authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->render('homepage.html.twig', [
                'title' => 'Accueil',
            ]);
        } else {
            return $this->redirectToRoute('signin');
        }
    }
}
