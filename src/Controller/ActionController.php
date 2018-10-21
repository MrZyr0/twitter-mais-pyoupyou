<?php

namespace App\Controller;

use App\Entity\Friend;
use App\Entity\Pyoupyou;
use App\Entity\User;
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
            $pyoupyou = $this->getDoctrine()->getRepository(Pyoupyou::class)->find($Id);
            $user = $accessChecker->getUSer();
            $user->addPyoupyousLike($pyoupyou);
            $this->addToBdd($user);
        }


        return $this->render('form/like.html.twig', [
            'pathController' => 'like',
            'pyoupyouId' => $pyoupyouId
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
    public function follow(Request $request, AccessChecker $accessChecker, $userId = -1)
    {
        if ($request->getMethod() == 'POST') {
            $newFriend = new Friend();
            $Id = $request->get('value');

            $user = $this->getDoctrine()->getRepository(User::class)->find($Id);
            $currentUser = $accessChecker->getUSer();

            $newFriend->setUserFrom($user);
            $newFriend->setUserTo($currentUser);
            $this->addToBdd($newFriend);
        }

        return $this->render('form/follow.html.twig', [
            'pathController' => 'follow',
            'userId' => $userId
        ]);
    }

    public function addToBdd($entity){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($entity);
        $entityManager->flush();
    }
}
