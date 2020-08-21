<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Images;
use App\Repository\ImagesRepository;
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
    public function index(ServiceRepository $repo, ImagesRepository $repogallery)
    {

        // Appel du contenu des tous les services photo
        $photos = $repo->findServicesPhoto();
        $gallery = $repogallery->findGallery(1);

        return $this->render(
            '/contents/prestations/photo.html.twig', 
            [ 
                'photos' => $photos,
                'gallery' => $gallery
            ]
        );
    }
}
