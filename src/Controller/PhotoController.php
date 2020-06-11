<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PhotoController extends AbstractController
{
    /**
     * @Route("/services/photographie", name="photo_index")
     * 
     * @return Response
     */
    public function index(ServiceRepository $repo) : Response
    {

        $portrait = $repo->findPortrait();
        $produit = $repo->findProduit();
        $maitrise = $repo->findSavoirFaire();
        $reportage = $repo->findReportageComplet();
        

        return $this->render('/contents/prestations/photo.html.twig', [
            'portrait' => $portrait,
            'produit' => $produit,
            'maitrise' => $maitrise,
            'reportage' => $reportage
        ]);
    }
}
