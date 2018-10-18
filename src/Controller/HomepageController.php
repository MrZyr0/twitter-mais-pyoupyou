<?php

namespace App\Controller;

use App\Entity\Pyoupyou;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Security\AccessChecker;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepage(AccessChecker $accessChecker)
    {

        if ($accessChecker->canReadHomepage())
        {
            $user = $accessChecker->getUser();
            $pyoupyous = $this->getFeed($user);
            return $this->render('homepage.html.twig', [
                'title' => 'Accueil',
                'user' => $user,
                'pyoupyous'=>$pyoupyous
            ]);
        }
        else
        {
            return $this->redirectToRoute('signin');
        }
    }

    public function getFeed($_user){
        return $this->getDoctrine()->getRepository(Pyoupyou::class)->findUserFeed($_user);
    }
}
