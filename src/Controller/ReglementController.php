<?php

namespace App\Controller;

use App\Entity\Reglement;
use App\Form\ReglementType;
use App\Repository\ReglementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/reglement")
 */
class ReglementController extends AbstractController
{
    /**
     * @Route("/", name="reglement_index", methods={"GET"})
     */
    public function index(ReglementRepository $reglementRepository,Request $request): Response
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
        return $this->render('reglement/index.html.twig', [
            'reglements' => $reglementRepository->findAll(),
        ]);
    }
    }
    /**
     * @Route("/lister", name="reglement_list", methods={"GET"})
     */
    public function lister(ReglementRepository $reglementRepository,Request $request): Response
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
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $reglement =  $reglementRepository->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('reglement/lister.html.twig', [
            'reglement' => $reglement,
        
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    }

    /**
     * @Route("/new", name="reglement_new", methods={"GET","POST"})
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
        $reglement = new Reglement();
        $form = $this->createForm(ReglementType::class, $reglement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reglement);
            $entityManager->flush();

            return $this->redirectToRoute('reglement_index');
        }

        return $this->render('reglement/new.html.twig', ['name'=>$name,
            'reglement' => $reglement,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="reglement_show", methods={"GET"})
     */
    public function show(Reglement $reglement,Request $request): Response
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
        return $this->render('reglement/show.html.twig', ['name'=>$name,
            'reglement' => $reglement,
        ]);
    }
    }
    /**
     * @Route("/{id}/edit", name="reglement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Reglement $reglement): Response
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
        $form = $this->createForm(ReglementType::class, $reglement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reglement_index');
        }

        return $this->render('reglement/edit.html.twig', ['name'=>$name,
            'reglement' => $reglement,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="reglement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Reglement $reglement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reglement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($reglement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reglement_index');
    }
}
