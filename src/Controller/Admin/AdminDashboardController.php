<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{

    /**
     * Permet d'afficher le contenu du dashboard
     * 
     * @Route("/admin", name="admin_dashboard")
     * @return Response
     */
    public function index()
    {

        return $this->render('admin/dashboard.html.twig', [

        ]);
    }
}