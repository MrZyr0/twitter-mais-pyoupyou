<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Security\AccessChecker;

use Symfony\Component\Security\Core\User\UserInterface;
use App\Form\PyoupyouType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Pyoupyou;
use Symfony\Component\Validator\Constraints\DateTime;


class NewPyoupyouController extends AbstractController
{
    /**
     * @Route("/newPyoupyou", name="new_pyou_pyou")
     */
    public function index(Request $request, AccessChecker $accessChecker)
    {


        $pyoupyou = new Pyoupyou;

        $form = $this->createForm(PyoupyouType::class, $pyoupyou);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid())
        {
            $pyoupyou = $form->getData();
            $pyoupyou->setUser( $accessChecker->getUSer() );
            $pyoupyou->setDate(new \DateTime());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pyoupyou);
            $entityManager->flush();
            // return $this->redirectToRoute('home');
        }

        return $this->render('new_pyou_pyou/index.html.twig', [
            'title' => 'Ecrire un PyouPyou',
            'form' => $form->createView(),
        ]);
    }
}
