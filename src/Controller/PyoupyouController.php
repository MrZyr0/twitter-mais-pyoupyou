<?php

namespace App\Controller;

use App\Entity\Pyoupyou;
use App\Form\PyoupyouType;
use App\Repository\PyoupyouRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/pyoupyou")
 */
class PyoupyouController extends AbstractController
{
    /**
     * @Route("/", name="pyoupyou_index", methods="GET")
     */
    public function index(PyoupyouRepository $pyoupyouRepository): Response
    {
        return $this->render('admin/pyoupyou/index.html.twig', ['pyoupyous' => $pyoupyouRepository->findAll()]);
    }

    /**
     * @Route("/new", name="pyoupyou_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $pyoupyou = new Pyoupyou();
        $form = $this->createForm(PyoupyouType::class, $pyoupyou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pyoupyou);
            $em->flush();

            return $this->redirectToRoute('pyoupyou_index');
        }

        return $this->render('admin/pyoupyou/new.html.twig', [
            'pyoupyou' => $pyoupyou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pyoupyou_show", methods="GET")
     */
    public function show(Pyoupyou $pyoupyou): Response
    {
        return $this->render('admin/pyoupyou/show.html.twig', ['pyoupyou' => $pyoupyou]);
    }

    /**
     * @Route("/{id}/edit", name="pyoupyou_edit", methods="GET|POST")
     */
    public function edit(Request $request, Pyoupyou $pyoupyou): Response
    {
        $form = $this->createForm(PyoupyouType::class, $pyoupyou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pyoupyou_edit', ['id' => $pyoupyou->getId()]);
        }

        return $this->render('admin/pyoupyou/edit.html.twig', [
            'pyoupyou' => $pyoupyou,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pyoupyou_delete", methods="DELETE")
     */
    public function delete(Request $request, Pyoupyou $pyoupyou): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pyoupyou->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pyoupyou);
            $em->flush();
        }

        return $this->redirectToRoute('pyoupyou_index');
    }
}
