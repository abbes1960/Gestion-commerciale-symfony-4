<?php

namespace App\Controller;

use App\Entity\Llivraison;
use App\Form\LlivraisonType;
use App\Repository\LlivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/llivraison")
 */
class LlivraisonController extends AbstractController
{
    /**
     * @Route("/", name="llivraison_index", methods={"GET"})
     */
    public function index(LlivraisonRepository $llivraisonRepository): Response
    {
        return $this->render('llivraison/index.html.twig', [
            'llivraisons' => $llivraisonRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="llivraison_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $llivraison = new Llivraison();
        $form = $this->createForm(LlivraisonType::class, $llivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($llivraison);
            $entityManager->flush();

            return $this->redirectToRoute('llivraison_index');
        }

        return $this->render('llivraison/new.html.twig', [
            'llivraison' => $llivraison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="llivraison_show", methods={"GET"})
     */
    public function show(Llivraison $llivraison): Response
    {
        return $this->render('llivraison/show.html.twig', [
            'llivraison' => $llivraison,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="llivraison_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Llivraison $llivraison): Response
    {
        $form = $this->createForm(LlivraisonType::class, $llivraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('llivraison_index');
        }

        return $this->render('llivraison/edit.html.twig', [
            'llivraison' => $llivraison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="llivraison_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Llivraison $llivraison): Response
    {
        if ($this->isCsrfTokenValid('delete'.$llivraison->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($llivraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('llivraison_index');
    }
}
