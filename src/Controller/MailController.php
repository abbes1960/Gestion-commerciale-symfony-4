<?php

namespace App\Controller;

use App\Entity\Mail;
use App\Form\MailType;
use App\Repository\MailRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mail")
 */
class MailController extends AbstractController
{
    /**
     * @Route("/send", name="mail_send", methods={"GET"})
     */
    public function index(\Swift_Mailer $mailer) : Response
    {
        $name = "Foulen";
       $message = (new \Swift_Message('Bonjour'))
        ->setFrom('testab.symfony@gmail.com')
        ->setTo('testab.symfony@gmail.com')
        ->setBody('Bonjour');
    $mailer->send($message);
    $this->addFlash('notice', 'Email sent');

    return $this->redirectToRoute('home');
}
   


/**
     * @Route("/home", name="home", methods={"GET"})
     */
    public function home() : Response
    {
        $name = "Foulen";
        return $this->render('mail/home.html.twig', ['name' => $name]);
           
        
    
    
   
}

    




   
   
}
