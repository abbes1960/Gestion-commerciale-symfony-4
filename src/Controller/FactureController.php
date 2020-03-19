<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Form\FactureType;
use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/facture")
 */
class FactureController extends AbstractController
{
    /**
     * @Route("/", name="facture_index", methods={"GET"})
     */
    public function index(FactureRepository $factureRepository,Request $request): Response
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
        return $this->render('facture/index.html.twig', ['name'=>$name,
            'factures' => $factureRepository->findAll(),
        ]);
    }
}
 /**
     * @Route("/listef", name="facture_list", methods={"GET"})
     */
    public function listef(FactureRepository $factureRepository,Request $request): Response
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
        $factures =  $factureRepository->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('facture/listef.html.twig', ['name'=>$name,
            'factures' => $factures,
        
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
     * @Route("/new", name="facture_new", methods={"GET","POST"})
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
        $facture = new Facture();
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($facture);
            $entityManager->flush();

            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/new.html.twig', ['name'=>$name,
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="facture_show", methods={"GET"})
     */
    public function show(Facture $facture,Request $request): Response
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
        return $this->render('facture/show.html.twig', ['name'=>$name,
            'facture' => $facture,
        ]);
    }
    }
    /**
     * @Route("/{id}/edit", name="facture_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Facture $facture): Response
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
        $form = $this->createForm(FactureType::class, $facture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('facture_index');
        }

        return $this->render('facture/edit.html.twig', ['name'=>$name,
            'facture' => $facture,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="facture_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Facture $facture): Response
    {
        if ($this->isCsrfTokenValid('delete'.$facture->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($facture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('facture_index');
    }
}
