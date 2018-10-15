<?php

namespace App\Controller;

use App\Form\SearchType;
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
        $searchForm = $this->createForm(SearchType::class);
        $searchForm->handleRequest($request);

        $searchValue = $searchForm->getData()['searchValue'];
        var_dump($searchValue);
        return $this->render('user/result.html.twig', [
            'controller_name' => 'ResultController',
            'title'=>'Result',
            'value'=>$searchValue
        ]);
    }
}
