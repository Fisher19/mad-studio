<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class MentionsLegalesController extends AbstractController {

    /**
     * Permet d'afficher les mentions légales dans nouvel onglet
     * 
     * @Route("/mentions-legales", name="mentions_index")
     * @return Response
     */
    public function index()
    {
        return $this->render('partials/mentions.html.twig', [

        ]);
    }
}
