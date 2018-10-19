<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Pyoupyou;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AccessChecker;

class GroupController extends AbstractController
{
    /**
     * @Route("/project/{id}", name="group")
     */
    public function index($id, AccessChecker $accessChecker)
    {
        $project = $this->getData($id);
        $pyoupyous = $this->getPyoupyous($project);

        return $this->render('user/project.html.twig', [
            'controller_name' => 'ProjectController',
            'title'=> $project->getName(),
            'entity' => $project,
            'user' =>$accessChecker->getUser(),
            'pyoupyous' => $pyoupyous
        ]);
    }

    public function getData($_id){
        return $this->getDoctrine()->getRepository(Project::class)->find($_id);
    }

    public function getPyoupyous($_project){
        return $this->getDoctrine()->getRepository(Pyoupyou::class)->findBy(array("project"=>$_project),array('date' => 'ASC'));
    }
}
