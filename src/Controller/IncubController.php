<?php

namespace App\Controller;

use App\Entity\Incubator;
use App\Entity\Pyoupyou;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AccessChecker;

class IncubController extends AbstractController
{
    /**
     * @Route("/incub/{id}", name="incub")
     */
    public function index($id, AccessChecker $accessChecker)
    {
        $user = $accessChecker->getUser();
        $incubator = $this->getData($id);
        if($accessChecker->canReadIncub($incubator)){

            $pyoupyous = $this->getPyoupyous($incubator);

            return $this->render('user/incubator.html.twig', [
                'controller_name' => 'IncubatorController',
                'title' => 'Incubateur',
                'entity' => $incubator,
                'user' =>$accessChecker->getUser(),
                'pyoupyous' => $pyoupyous,
                'entityUsers' => $this->getUsers($incubator)
            ]);
        }
        else
        {
            return $this->redirectToRoute('signin');
        }

    }

    public function getData($id){
        return $this->getDoctrine()->getRepository(Incubator::class)->find($id);
    }

    public function getPyoupyous($incubator){
        return $this->getDoctrine()->getRepository(Pyoupyou::class)->findBy(array("incubator"=>$incubator),array('date' => 'ASC'));
    }

    public function getUsers($incubator){
        return  $this->getDoctrine()->getRepository(User::class)->findAllByIncub($incubator);
    }
}
