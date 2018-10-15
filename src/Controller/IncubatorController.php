<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IncubatorController extends AbstractController
{
    /**
     * @Route("/incubator", name="incubator")
     */
    public function index()
    {
        return $this->render('incubator/index.html.twig', [
            'controller_name' => 'IncubatorController',
        ]);
    }
}
