<?php
namespace App\Controller;

use App\Entity\Pack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class PackController extends AbstractController {

    /**
     * @Route("/contents/full-pack", name="pack_index")
     * 
     * @return Response
     */
    
    public function pack() {
    
        $pack = $this->getDoctrine()
            ->getManager()
            ->getRepository(Pack::class)
            ->findAll();
    
        return $this->render(
            '/contents/prestations/pack.html.twig', 
            [ 
                'pack' => $pack
            ]
        );
    }
}