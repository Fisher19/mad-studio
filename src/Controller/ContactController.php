<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contents/contact", name="contact_index")
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $manager, \Swift_Mailer $mailer)
    {
               // création du formulaire de contact
               $contact = new Contact();
               $form = $this->createForm(ContactType::class, $contact);
               $form->handleRequest($request);
       
               if($form->isSubmitted() && $form->isValid()) {
                   $manager->persist($contact);
                   $manager->flush();
       
               $message = (new \Swift_Message('Demande de contact'))
               ->setFrom('send@example.com')
               ->setTo('maddev1919@gmail.com')
               ->setBody(
                   $this->renderView(
                       'message.html.twig',
                       ['contact' => $contact]
                   ),
                   'text/html'
               )
           ;
       
           $mailer->send($message);
       
           $this->addFlash(
               'success',
               "Votre message à bien été envoyé !"
           );  
       
           return $this->redirectToRoute('main_page', ['_fragment' => 'contact']);
        }
       
               return $this->render('contents/contact/contact.html.twig', [
                   'form' => $form->createView()
               ]);
           }
    }
