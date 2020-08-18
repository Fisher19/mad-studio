<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact_index")
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $manager, MailerInterface $mailer)
    {
        // création du formulaire de contact
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
       
        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($contact);
            $manager->flush();
        
            $message = (new TemplatedEmail())
            ->from($contact->getMail('mail'))
            ->to('maddev1919@gmail.com')
            ->subject('Contact depuis le site')
            ->htmlTemplate('contents/contact/message.html.twig')
            ->context([
                'lastname' => $contact->getLastname(),
                'compagny' => $contact->getCompagny(),
                'phone' => $contact->getPhone(),
                'mail' => $contact->getMail(),
                'category' => $contact->getCategory(),
                'message' => $contact->getMessage()
            ]);
            
        $mailer->send($message);
       
        $this->addFlash(
            'success',
            "Votre message à bien été envoyé !"
        );  
       
           return $this->redirectToRoute('contact_index', ['_fragment' => 'contact']);
        }
       
               return $this->render('contents/contact/contact.html.twig', [
                   'form' => $form->createView()
               ]);
           }
    }
