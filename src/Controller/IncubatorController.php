<?php

namespace App\Controller;

use App\Entity\Incubator;
use App\Entity\Pyoupyou;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AccessChecker;

class IncubatorController extends AbstractController
{
    /**
     * @Route("/incubator/{id}", name="incubator")
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

    public function getData($_incubator){
        return $project = $this->getDoctrine()->getRepository(Incubator::class)->find($_id);
    }

    public function getPyoupyous($_incubator){
        return $pyoupyous = $this->getDoctrine()->getRepository(Pyoupyou::class)->findBy(array("incubator"=>$_incubator),array('date' => 'ASC'));
    }
}
