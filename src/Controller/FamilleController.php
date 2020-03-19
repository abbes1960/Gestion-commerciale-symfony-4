<?php

namespace App\Controller;

use App\Entity\Famille;
use App\Form\FamilleType;
use App\Repository\FamilleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/famille")
 */
class FamilleController extends AbstractController
{
    /**
     * @Route("/", name="famille_index", methods={"GET"})
     */
    public function index(FamilleRepository $familleRepository,Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        return $this->render('famille/index.html.twig', ['name'=>$name,
            'familles' => $familleRepository->findAll(),
        ]);
        }
    }

    /**
     * @Route("/new", name="famille_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        $famille = new Famille();
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($famille);
            $entityManager->flush();

            return $this->redirectToRoute('famille_index');
        }

        return $this->render('famille/new.html.twig', [
            'famille' => $famille,'name'=>$name,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="famille_show", methods={"GET"})
     */
    public function show(Famille $famille,Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        return $this->render('famille/show.html.twig', ['name'=>$name,
            'famille' => $famille,
        ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="famille_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Famille $famille): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('famille_index');
        }

        return $this->render('famille/edit.html.twig', ['name'=>$name,
            'famille' => $famille,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="famille_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Famille $famille): Response
    {
        if ($this->isCsrfTokenValid('delete'.$famille->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($famille);
            $entityManager->flush();
        }

        return $this->redirectToRoute('famille_index');
    }
}
