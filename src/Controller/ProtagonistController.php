<?php

namespace App\Controller;

use App\Entity\Protagonist;
use App\Form\ProtagonistType;
use App\Repository\ProtagonistRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/protagonist")
 */
class ProtagonistController extends AbstractController
{
    /**
     * @Route("/", name="protagonist_index", methods={"GET"})
     * @param ProtagonistRepository $protagonistRepository
     * @return Response
     */
    public function index(ProtagonistRepository $protagonistRepository): Response
    {
        return $this->render('protagonist/index.html.twig', [
            'protagonists' => $protagonistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="protagonist_new", methods={"GET","POST"})
     * @param Request $request
     * @param MailerInterface $mailer
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function new(Request $request, MailerInterface $mailer): Response
    {
        $protagonist = new Protagonist();

        $form = $this->createForm(ProtagonistType::class, $protagonist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $protagonist->setUpdatedAt(new \DateTime('now'));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($protagonist);
            $email = (new TemplatedEmail())
                ->from(new Address('my-hero-academia@admin.team', 'Benji from my hero academia'))
                ->to('benjamin.beugnet@wildcodeschool.fr')
                ->subject('Here comes a NEW challenger !')
                ->attachFromPath('build/picture/default.png', 'mha stamp')
                ->htmlTemplate('emails/newProtagonist.html.twig')
                ->context([
                    'protagonist' => $protagonist->getName(),
                ]);

            $entityManager->flush();
            $sendMyMail = $mailer->send($email);

            return $this->redirectToRoute('protagonist_index');
        }

        return $this->render('protagonist/new.html.twig', [
            'protagonist' => $protagonist,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="protagonist_show", methods={"GET"})
     * @param Protagonist $protagonist
     * @return Response
     */
    public function show(Protagonist $protagonist): Response
    {
        return $this->render('protagonist/show.html.twig', [
            'protagonist' => $protagonist,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="protagonist_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Protagonist $protagonist
     * @return Response
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
     * @param Request $request
     * @param Protagonist $protagonist
     * @return Response
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
