<?php
namespace App\Controller;

use App\Entity\About;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class AboutController extends AbstractController {

    /**
     * @Route("/a-propos", name="about_index")
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