<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\SignUpType;

class SignUpController extends AbstractController
{
    /**
    * @Route("/signup", name="signup")
    */
    public function signup(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(signupType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {
            $user = $form->getData();

            $plainPassword = $user->getPassword();
            $encryptedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encryptedPassword);


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/signup.html.twig', [
            'title' => "Inscription",
            'form' => $form->createView(),
        ]);
    }
}
