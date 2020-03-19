<?php

namespace App\Controller;
use App\Entity\Compteur;
use App\Entity\Commande;
use App\Entity\Lcommande;
use App\Form\CommandeType;
use App\Form\LcommandeType;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProduitRepository;
use App\Repository\LcommandeRepository;
use App\Repository\CompteurRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
/**
 * @Route("/commande")
 */
class CommandeController extends AbstractController
{
    /**
     * @Route("/", name="commande_index", methods={"GET"})
     */
    public function index(CommandeRepository $commandeRepository,Request $request): Response
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
    return $this->render('commande/index.html.twig', ['name'=>$name,
        'commandes' => $commandeRepository->findAll(),
    ]);
  }
       
    }
    
    /**
     * @Route("/listec", name="commande_list", methods={"GET"})
     */
    public function listec(CommandeRepository $commandeRepository,Request $request): Response
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
        $commandes =  $commandeRepository->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('commande/listec.html.twig', [
            'commandes' => $commandes,
        
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
     * @Route("/new", name="commande_new", methods={"GET","POST"})
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
        $numc= $compteur->getNumcom();
        $commande = new Commande();
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);
        $lcommande = new LCommande();
        $f = $this->createForm(LcommandeType::class, $lcommande);
        $f->handleRequest($request);
        $totht = 0;
        $totva = 0;
        $totttc = 0;
        $montht = 0;
        $lig = 0;
       
        if (!$session->has('commande'))
            {
                $session->set('commande',array());
                
            }
            $session = $request->getSession();
            $name = $session->get('name');
            $choix = "";
        $Tabcomm = $session->get('commande', []);
       
        if ($form->isSubmitted() || $f->isSubmitted()) {
        
            $choix = $request->get('bt');
            if($choix =="Valider"){
            $em = $this->getDoctrine()->getManager();
            $lig = sizeof($Tabcomm);
            for ($i = 1;$i<=$lig;$i++)
            {
            $lcommande = new Lcommande();
            $prod = $produitRepository->findOneBy(array('id'=>$Tabcomm[$i]->getProduit()));
            $lcommande->setProduit($prod);
            $lcommande->setLig($i);
            $lcommande->setNumc($numc);
            $lcommande->setPv($Tabcomm[$i]->getPv());
            $lcommande->setQte($Tabcomm[$i]->getQte());
            $lcommande->setTva($Tabcomm[$i]->getTva());
            $em->persist($lcommande);
            $em->flush();
            $montht = $Tabcomm[$i]->getPv()*$Tabcomm[$i]->getQte();
            $monttva = $montht *($Tabcomm[$i]->getTva())*0.01;
            $totht = $totht + $montht;
            $totva = $totva + $monttva;
            $totttc = $totttc + ($totht + $totva);
            }
            
            $commande->setNumC($numc);
            $commande->setTotht($totht);
            $commande->setTottva($totva);
            $commande->setTotttc($totttc);
            $em->persist($commande);
          
            $compteur->setNumcom($numc+1);
            $em->persist($compteur);
            $em->flush();
            $session->clear();
            }
             else if($choix =="Add"){
            $montht = $lcommande->getPv()*$lcommande->getQte();
            $lig = sizeof($Tabcomm)+1;
            $lcommande->setNumC($numc);
            $lcommande->setLig($lig);
            $Tabcomm[$lig] = $lcommande;
            $session->set('commande',$Tabcomm);
             }  
        }
        return $this->render('commande/new.html.twig', [
            'commande' => $commande,'lcomm'=>$Tabcomm,
            'form' => $form->createView(),
            'lcommande' => $lcommande,'name'=>$name,
            'f' => $f->createView(),'numc'=>$numc,
            'totht'=>$totht,'totva'=>$totva,
            'totttc'=>$totttc,'montht'=>$montht,'lig'=>$lig,

        ]);
           }
        }

    /**
     * @Route("/{id}/edit", name="commande_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commande $commande): Response
    {
        $form = $this->createForm(CommandeType::class, $commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande_index');
        }

        return $this->render('commande/edit.html.twig', [
            'commande' => $commande,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commande $commande): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande_index');
    }

    /**
     * @Route("/supprime/{id}", name="supprime")
     */

    public function supprime($id, Request $request){
        $session = $request->getSession();
        $Tabcomm= $session->get('commande', []);
        if (array_key_exists($id, $Tabcomm))
        {
            unset($Tabcomm[$id]);
            $session->set('commande',$Tabcomm);
        }
        return $this->redirectToRoute('commande_new'); 

    }
}
