<?php

namespace App\Controller\Admin;

use App\Entity\About;
use App\Form\AboutType;
use App\Repository\AboutRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminAboutController extends AbstractController
{
    /**
     *
     * @var AboutRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(AboutRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * Permet d'afficher A propos
     * 
     * @Route("/admin/about", name="admin_about_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $about = $this->repository->findAll();

        return $this->render('admin/content/about/index.html.twig', [
            'about' => $about,
        ]);
    }


    /**
     * Permet d'éditer A propos
     * 
     * @Route("/admin/content/about/{id}/edit", name="admin_about_edit")
     * 
     * @param About $about
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(About $about, Request $request)
    {
        $form = $this->createForm(AboutType::class, $about);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash(
                'success',
                " '{$about->getTitle()}' a bien été modifié !"
            );

            return $this->redirectToRoute('admin_about_index');
        }

        return $this->render('admin/content/about/edit.html.twig', [
            'about' => $about,
            'form' => $form->createView()
        ]);
    }

}
