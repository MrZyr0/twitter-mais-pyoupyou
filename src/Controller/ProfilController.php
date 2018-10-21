<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Pyoupyou;
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
        $user = $this->getUserData($id);
        $pyoupyous = $this->getPyoupyous($user);
        if($accessChecker->canReadProfil($user)){
            return $this->render('user/profil.html.twig', [
                'controller_name' => 'ProfilController',
                'entity' => $user,
                'user' => $accessChecker->getUser(),
                'title' => 'Profil',
                'pyoupyous' => $pyoupyous
            ]);
        }
        else
        {
            return $this->redirectToRoute('signin');
        }
    }

    public function getUserData($_id){
        return $this->getDoctrine()->getRepository(User::class)->find($_id);
    }

    public function getPyoupyous($user){
        //return $this->getDoctrine()->getRepository(Pyoupyou::class)->findBy(array("user"=>$user),array('date' => 'DESC'));
        return $this->getDoctrine()->getRepository(Pyoupyou::class)->findAllByUser($user);
    }

}
