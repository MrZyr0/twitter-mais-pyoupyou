<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AccessChecker;

class ProjectController extends AbstractController
{
    /**
     * @Route("/project/{id}", name="project")
     */
    public function index($id, AccessChecker $accessChecker)
    {
        $project = $this->getProjectData($id);

        return $this->render('user/project.html.twig', [
            'controller_name' => 'ProjectController',
            'title'=> $project->getName(),
            'entity' => $project,
            'user' =>$accessChecker->getUser()
        ]);
    }

    public function getProjectData($_id){
        return $project = $this->getDoctrine()->getRepository(Project::class)->find($_id);
    }
}
