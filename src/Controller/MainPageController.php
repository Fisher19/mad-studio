<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainPageController extends AbstractController
{
    /**
     * @Route("/", name="main_page")
     * 
     * @return Response
     */
    public function index(ServiceRepository $repo) : Response
    {

        $photos = $repo->findServicesPhoto();
        $sites = $repo->findServicesSite();

        return $this->render('base.html.twig', [
            'photos' => $photos,
            'sites' => $sites
        ]);
    }
}
