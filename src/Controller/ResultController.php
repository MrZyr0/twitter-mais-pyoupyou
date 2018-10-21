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
        $isConnected = $accessChecker->isConnected();
        $results = $this->getResults($searchValue, $isConnected);

        return $this->render('user/result.html.twig', [
            'controller_name' => 'ResultController',
            'title'=>'Result',
            'results'=>$results,
            'user' =>$accessChecker->getUser()
        ]);
    }

    function getResults($searchValue, $isConnected )
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
            if ($isConnected){
                $dataRepo = ($searchValue != "")? $repo->findByValue($searchValue) : $repo->findAll();

            }else{
                $dataRepo = ($searchValue != "")? $repo->findPublicByValue($searchValue) : $repo->findAllPublic();
            }
            $data[$key] = $dataRepo;
        }

        return $data;
    }
}
