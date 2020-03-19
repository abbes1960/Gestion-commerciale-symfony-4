<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Entity\Llivraison;
use App\Form\LivraisonType;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\LlivraisonRepository;
use App\Form\LlivraisonType;
use App\Repository\CompteurRepository;
use App\Entity\Compteur;
use Dompdf\Dompdf;
use Dompdf\Options;

/**
 * @Route("/livraison")
 */
class LivraisonController extends AbstractController
{
    /**
     * @Route("/", name="livraison_index", methods={"GET"})
     */
    public function index(LivraisonRepository $livraisonRepository,Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
           {
               $this->get('session')->getFlashBag()->add('info', 'login de Connection veuillez se connecter .... ....');
               return $this->render('user/login.html.twig');
           }
           else
            {
                $name = $session->get('name');
         return $this->render('livraison/index.html.twig', ['name'=>$name,
             'livraisons' => $livraisonRepository->findAll(),
         ]);
     }
     }
     /**
     * @Route("/listel", name="livraison_list", methods={"GET"})
     */
    public function listel(LivraisonRepository $livraisonRepository,Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
           {
               $this->get('session')->getFlashBag()->add('info', 'login de Connection veuillez se connecter .... ....');
               return $this->render('user/login.html.twig');
           }
           else
            {
                $name = $session->get('name');
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('livraison/listel.html.twig', ['name'=>$name,
            'livraison' => $livraisonRepository->findAll(),
        
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
     * @Route("/new", name="livraison_new", methods={"GET","POST"})
     */
    public function new(Request $request,ProduitRepository $produitRepository,CompteurRepository $compteurRepository): Response
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
        $compteur = $compteurRepository->find(1);
        $numl= $compteur->getNuml();
        
        if (!$session->has('liv'))
            {
                $livraison = new Livraison();
               
            }
           
           
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);
        $Llivraison = new Llivraison();
        $f = $this->createForm(LlivraisonType::class, $Llivraison);
        $f->handleRequest($request);
        $totht = 0;
        $tottva = 0;
        $totttc = 0;
        $montht = 0;
        $lig = 0;
        
        if (!$session->has('Llivraison'))
            {
                $session->set('Llivraison',array());
                
            }
            $choix = "";
        $Tabliv = $session->get('Llivraison', []);
       
        if ($form->isSubmitted() || $f->isSubmitted()) {
        
            $choix = $request->get('bt');
            if($choix =="Valider"){
            $em = $this->getDoctrine()->getManager();
            $lig = sizeof($Tabliv);
            for ($i = 1;$i<=$lig;$i++)
            {
            $Llivraison = new Llivraison();
            $prod = $produitRepository->findOneBy(array('id'=>$Tabliv[$i]->getProduit()));
            $Llivraison->setProduit($prod);
            $Llivraison->setLig($i);
            $Llivraison->setNuml($numl);
            $Llivraison->setPv($Tabliv[$i]->getPv());
            $Llivraison->setQte($Tabliv[$i]->getQte());
            $Llivraison->setTva($Tabliv[$i]->getTva());
            $em->persist($Llivraison);
            $em->flush();
            $montht = $Tabliv[$i]->getPv()*$Tabliv[$i]->getQte();
            $monttva = $montht *($Tabliv[$i]->getTva())*0.01;
            $totht = $totht + $montht;
            $tottva = $tottva + $monttva;
            $totttc = $totttc + ($totht + $tottva);
            $livraison->setNuml($numl);
            $livraison->setTotht($totht);
            $livraison->setTottva($tottva);
            $livraison->setTotttc($totttc);
            $em->persist($livraison);
            $compteur->setNuml($numl+1);
            $em->persist($compteur);
            $em->flush();
            $session->clear();
        }
    }
             else if($choix =="Add"){
            $montht = $Llivraison->getPv()*$Llivraison->getQte();
            $lig = sizeof($Tabliv)+1;
            $Llivraison->setNuml($numl);
            $Llivraison->setLig($lig);
            $Tabliv[$lig] = $Llivraison;
            $session->set('Llivraison',$Tabliv);
             }  
        }
    
        return $this->render('Livraison/new.html.twig', [
            'livraison' => $livraison,'lliv'=>$Tabliv,
            'form' => $form->createView(),'name'=>$name,
            'Llivraison' => $Llivraison,
            'f' => $f->createView(),'numl'=>$numl,
            'totht'=>$totht,'tottva'=>$tottva,
            'totttc'=>$totttc,'montht'=>$montht,'lig'=>$lig,

        ]);


    }
    }
    /**
     * @Route("/{id}/edit", name="livraison_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livraison $livraison): Response
    {
        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('livraison_index');
        }

        return $this->render('livraison/edit.html.twig', [
            'livraison' => $livraison,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="livraison_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Livraison $livraison): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livraison->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livraison);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livraison_index');
    }
    /**
     * @Route("/supprime/{id}", name="supprime")
     */
    
    public function supprime($id,Request $request){
        $session = $request->getSession();
        $Tabliv= $session->get('Llivraison', []);
        if (array_key_exists($id, $Tabliv))
        {
            unset($Tabliv[$id]);
            $session->set('Llivraison',$Tabliv);
         
        }
        return $this->redirectToRoute('livraison_new'); 

    }
}
