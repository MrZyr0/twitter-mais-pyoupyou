<?php

namespace App\Controller;

use App\Entity\Incubator;
use App\Entity\Pyoupyou;
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
        $incubator = $this->getData($id);
        $pyoupyous = $this->getPyoupyous($incubator);
        return $this->render('user/incubator.html.twig', [
            'controller_name' => 'IncubatorController',
            'title' => $incubator->getName(),
            'entity' => $incubator,
            'user' =>$accessChecker->getUser(),
            'pyoupyous' => $pyoupyous
        ]);
    }

    public function getData($_id){
        return $this->getDoctrine()->getRepository(Incubator::class)->find($_id);
    }

    public function getPyoupyous($_incubator){
        return $this->getDoctrine()->getRepository(Pyoupyou::class)->findBy(array("incubator"=>$_incubator),array('date' => 'ASC'));
    }
}
