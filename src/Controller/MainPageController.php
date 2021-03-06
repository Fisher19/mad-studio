<?php

namespace App\Controller;

use App\Entity\Argument;
use App\Repository\ServiceRepository;
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
    public function index(ServiceRepository $repo) : Response
    {
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
