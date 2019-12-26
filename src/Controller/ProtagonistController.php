<?php

namespace App\Controller;

use App\Entity\Protagonist;
use App\Form\ProtagonistType;
use App\Repository\ProtagonistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/protagonist")
 */
class ProtagonistController extends AbstractController
{
    /**
     * @Route("/", name="protagonist_index", methods={"GET"})
     */
    public function index(ProtagonistRepository $protagonistRepository): Response
    {
        return $this->render('protagonist/index.html.twig', [
            'protagonists' => $protagonistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="protagonist_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $protagonist = new Protagonist();
        $form = $this->createForm(ProtagonistType::class, $protagonist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($protagonist);
            $entityManager->flush();

            return $this->redirectToRoute('protagonist_index');
        }

        return $this->render('protagonist/new.html.twig', [
            'protagonist' => $protagonist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protagonist_show", methods={"GET"})
     */
    public function show(Protagonist $protagonist): Response
    {
        return $this->render('protagonist/show.html.twig', [
            'protagonist' => $protagonist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="protagonist_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Protagonist $protagonist): Response
    {
        $form = $this->createForm(ProtagonistType::class, $protagonist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('protagonist_index');
        }

        return $this->render('protagonist/edit.html.twig', [
            'protagonist' => $protagonist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protagonist_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Protagonist $protagonist): Response
    {
        if ($this->isCsrfTokenValid('delete'.$protagonist->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($protagonist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('protagonist_index');
    }
}
