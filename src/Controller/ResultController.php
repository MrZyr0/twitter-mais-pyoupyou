<?php

namespace App\Controller;

use App\Entity\Incubator;
use App\Entity\Project;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Security\AccessChecker;

class ResultController extends AbstractController
{
    /**
     * @Route("/result", name="result")
     */
    public function index(Request $request, AccessChecker $accessChecker)
    {
        $searchValue = $request->get('searchValue');

        $results = $this->getResults($searchValue);

        return $this->render('user/result.html.twig', [
            'controller_name' => 'ResultController',
            'title'=>'Result',
            'results'=>$results,
            'user' =>$accessChecker->getUser()
        ]);
    }

    function getResults($_searchValue)
    {
        $classes = [
            'User'=> User::class,
            'Project' => Project::class,
            'Incubator' => Incubator::class
        ];

        $repositories = [];
        $data = [];
        foreach ($classes as $key => $class) {
            $repositories[$key] = $this->getDoctrine()->getRepository($class);
        }

        foreach ($repositories as $key => $repo) {
            $dataRepo = ($_searchValue != "")? $repo->findPublicByValue($_searchValue) : $repo->findAllPublic();
            $data[$key] = $dataRepo;
        }

        return $data;
    }
}
