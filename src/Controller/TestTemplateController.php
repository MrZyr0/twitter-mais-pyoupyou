<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestTemplateController extends AbstractController
{
    /**
     * @Route("/test/template", name="test_template")
     */
    public function index()
    {
        return $this->render('test_template/index.html.twig', [
            'controller_name' => 'TestTemplateController',
            'title' => 'test'
        ]);
    }
}
