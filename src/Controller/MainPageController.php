<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainPageController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     * 
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $manager, ServiceRepository $repo, \Swift_Mailer $mailer) : Response
    {

        // appel des services Photo et Site
        $photos = $repo->findServicesPhoto();
        $sites = $repo->findServicesSite();


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

        return $this->render('base.html.twig', [
            'photos' => $photos,
            'sites' => $sites,
            'form' => $form->createView()
        ]);
    }
}
