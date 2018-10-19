<?php

namespace App\Controller;

use App\Entity\Incubator;
use App\Form\IncubatorType;
use App\Repository\IncubatorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/incubator")
 */
class IncubatorController extends AbstractController
{
    /**
     * @Route("/", name="incubator_index", methods="GET")
     */
    public function index(IncubatorRepository $incubatorRepository): Response
    {
        return $this->render('admin/incubator/index.html.twig', ['incubators' => $incubatorRepository->findAll()]);
    }

    /**
     * @Route("/new", name="incubator_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $incubator = new Incubator();
        $form = $this->createForm(IncubatorType::class, $incubator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($incubator);
            $em->flush();

            return $this->redirectToRoute('incubator_index');
        }

        return $this->render('admin/incubator/new.html.twig', [
            'incubator' => $incubator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="incubator_show", methods="GET")
     */
    public function show(Incubator $incubator): Response
    {
        return $this->render('admin/incubator/show.html.twig', ['incubator' => $incubator]);
    }

    /**
     * @Route("/{id}/edit", name="incubator_edit", methods="GET|POST")
     */
    public function edit(Request $request, Incubator $incubator): Response
    {
        $form = $this->createForm(IncubatorType::class, $incubator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('incubator_edit', ['id' => $incubator->getId()]);
        }

        return $this->render('admin/incubator/edit.html.twig', [
            'incubator' => $incubator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="incubator_delete", methods="DELETE")
     */
    public function delete(Request $request, Incubator $incubator): Response
    {
        if ($this->isCsrfTokenValid('delete'.$incubator->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($incubator);
            $em->flush();
        }

        return $this->redirectToRoute('incubator_index');
    }
}
