<?php

namespace App\Controller;

use App\Entity\Incubator;
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
        $incubator = $this->getIncubatorData($id);
        return $this->render('user/incubator.html.twig', [
            'controller_name' => 'IncubatorController',
            'title' => $incubator->getName(),
            'entity' => $incubator,
            'user' =>$accessChecker->getUser()
        ]);
    }

    public function getIncubatorData($_id){
        return $project = $this->getDoctrine()->getRepository(Incubator::class)->find($_id);
    }
}
