<?php

namespace App\Controller;

use App\Entity\Lcommande;
use App\Form\LcommandeType;
use App\Repository\LcommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lcommande")
 */
class LcommandeController extends AbstractController
{
    /**
     * @Route("/", name="lcommande_index", methods={"GET"})
     */
    public function index(LcommandeRepository $lcommandeRepository): Response
    {
        return $this->render('lcommande/index.html.twig', [
            'lcommandes' => $lcommandeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lcommande_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lcommande = new Lcommande();
        $form = $this->createForm(LcommandeType::class, $lcommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lcommande);
            $entityManager->flush();

            return $this->redirectToRoute('lcommande_index');
        }

        return $this->render('lcommande/new.html.twig', [
            'lcommande' => $lcommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lcommande_show", methods={"GET"})
     */
    public function show(Lcommande $lcommande): Response
    {
        return $this->render('lcommande/show.html.twig', [
            'lcommande' => $lcommande,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lcommande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lcommande $lcommande): Response
    {
        $form = $this->createForm(LcommandeType::class, $lcommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lcommande_index', [
                'id' => $lcommande->getId(),
            ]);
        }

        return $this->render('lcommande/edit.html.twig', [
            'lcommande' => $lcommande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lcommande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lcommande $lcommande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lcommande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lcommande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lcommande_index');
    }
}
