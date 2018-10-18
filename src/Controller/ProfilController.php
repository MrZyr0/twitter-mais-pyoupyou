<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AccessChecker;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil/{id}", name="profil")
     */
    public function index(AccessChecker $accessChecker, $id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        if($accessChecker->canReadProfil($user)){
            $userConnected = $accessChecker->getUser();
            return $this->render('user/profil.html.twig', [
                'controller_name' => 'ProfilController',
                'entity' => $user,
                'user' => $userConnected,
                'title' => 'Profil'
            ]);
        }
        else
        {
            return $this->redirectToRoute('signin');
        }
    }

}
