<?php
namespace App\Controller;

use App\Entity\About;
use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AboutController extends AbstractController {

/**
 * @Route("/contents/a-propos", name="about_index")
 * 
 * @return Response
 */

public function about() {

    $about = $this->getDoctrine()
        ->getManager()
        ->getRepository(About::class)
        ->findAll();

    return $this->render(
        '/contents/about/about.html.twig', 
        [ 
            'about' => $about
        ]
    );
}
}