<?php

namespace App\Controller;


use App\Entity\Incubator;
use App\Entity\Project;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{
    /**
     * @Route("/result", name="result")
     */
    public function index(Request $request)
    {
        $searchValue = $request->get('searchValue');

        $results = $this->getResults($searchValue);

        var_dump($results);
        return $this->render('user/result.html.twig', [
            'controller_name' => 'ResultController',
            'title'=>'Result',
            'results'=>$results
        ]);
    }

    function getResults($_searchValue){

        $userRepo = $this->getDoctrine()->getRepository(User::class);
        $projectRepo = $this->getDoctrine()->getRepository(Project::class);
        $incubatorRepo = $this->getDoctrine()->getRepository(Incubator::class);

        $repositories = [$userRepo, $projectRepo, $incubatorRepo];
        $data = [];

        foreach ($repositories as $repo){
            $dataRepo = ($_searchValue != "")? $repo->findPublicByValue($_searchValue) : $repo->findPublic();
            $data [] = $dataRepo;
        }

        return $data;

    }
}
