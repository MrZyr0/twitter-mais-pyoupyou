<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\SignUpType;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use App\Security\AccessChecker;

class SignUpController extends AbstractController
{
    /**
    * @Route("/SignUp", name="signup")
    */
    public function signup(Request $request, UserPasswordEncoderInterface $encoder, AccessChecker $accessChecker)
    {

        if ($accessChecker->isConnected())
        {
            return $this->redirectToRoute('signin');
        }
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



            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);

            // If the firewall name is not main, then the set value would be instead:
            // $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
            $this->get('session')->set('_security_main', serialize($token));

            // Fire the login event manually
            // $event = new InteractiveLoginEvent($request, $token);
            // $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('user/signup.html.twig', [
            'title' => "Inscription",
            'form' => $form->createView(),
        ]);
    }
}
