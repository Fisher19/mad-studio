<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SiteController extends AbstractController
{
    /**
     * @Route("/services/site-internet", name="site_index")
     * 
     * @return Response
     */
    public function index(ServiceRepository $repo) : Response
    {

        $vitrine = $repo->findVitrine();
        $ecommerce = $repo->findCommerce();
        $refont = $repo->findRefont();
        $blog = $repo->findBlog();
        

        return $this->render('/contents/prestations/site.html.twig', [
            'vitrine' => $vitrine,
            'ecommerce' => $ecommerce,
            'refont' => $refont,
            'blog' => $blog
        ]);
    }
}
