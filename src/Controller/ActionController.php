<?php

namespace App\Controller;

use App\Entity\Pyoupyou;
use App\Security\AccessChecker;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ActionController extends AbstractController
{


    /**
     * @Route("/like", name="like")
     */
    public function like(Request $request, AccessChecker $accessChecker, $pyoupyouId = -1)
    {
        if ($request->getMethod() == 'POST'){
            $Id = $request->get('value');
            $user = $accessChecker->getUSer();
            $user->setLikesId($user->getLikesId()[] = $pyoupyouId);
            $this->addToBdd($user);
        }


        return $this->render('form/like.html.twig', [
            'pathController' => 'like',
            'pyoupyouID' => $pyoupyouId
        ]);
    }

    /**
     * @Route("/repost", name="repost")
     */
    public function repost(Request $request, AccessChecker $accessChecker, $pyoupyouId = -1)
    {
        if ($request->getMethod() == 'POST') {
            $Id = $request->get('value');
            $pyoupyou = $this->getDoctrine()->getRepository(Pyoupyou::class)->find($Id);
            $user = $accessChecker->getUSer();
            $user->addRepost($pyoupyou);
            $this->addToBdd($user);
        }
        return $this->render('form/repost.html.twig', [
            'pathController' => 'repost',
            'pyoupyouId' => $pyoupyouId
        ]);
    }

    /**
     * @Route("/follow", name="follow")
     */
    public function follow(Request $request, AccessChecker $accessChecker)
    {
        return $this->render('form/follow.html.twig', [
            'pathController' => 'follow'
        ]);
    }

    public function addToBdd($entity){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($entity);
        $entityManager->flush();
    }
}
