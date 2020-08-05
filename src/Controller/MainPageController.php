<?php

namespace App\Controller;

use App\Entity\Argument;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;

class MainPageController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     * 
     * @return Response
     */
    public function index(ServiceRepository $repo, Request $request) : Response
    {

        // // récupérer la session
        // $session = $request->getSession();

        // // on récupère la variable de session
        // $test = $session->get('test');

        // if (isset($test)) {
        //     echo 'session ouverte, j\'ai récupéré ma variable : ' . $test;
        // }
        // else {
        //     echo 'j\'initialise ma session et j\y insere une nouvelle variable';
        //     // j'insere une variable de session de clé test
        //     $session->set('test', 'coucou');
        // }

        // appel des blocs Services Photo et Site
        $photos = $repo->findServicesPhoto();
        $sites = $repo->findServicesSite();

        // appel du bloc Arguments
        $arguments = $this->getDoctrine()
        ->getManager()
        ->getRepository(Argument::class)
        ->findAll();

        return $this->render('base.html.twig', [
            'photos' => $photos,
            'sites' => $sites,
            'arguments' => $arguments
        ]);
    }
}
