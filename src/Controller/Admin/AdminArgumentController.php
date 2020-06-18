<?php

namespace App\Controller\Admin;

use App\Entity\Argument;
use App\Form\ArgumentType;
use App\Repository\ArgumentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminArgumentController extends AbstractController
{
    /**
     *
     * @var ArgumentRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ArgumentRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * Permet d'afficher les différents arguments
     * 
     * @Route("/admin/content/arguments", name="admin_arguments_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $arguments = $this->repository->findAll();

        return $this->render('admin/content/arguments/index.html.twig', [
            'arguments' => $arguments,
        ]);
    }


    /**
     * Permet d'éditer les différents arguments
     * 
     * @Route("/admin/content/argument/{id}/edit", name="admin_arguments_edit")
     * 
     * @param Argument $argument
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Argument $argument, Request $request)
    {
        $form = $this->createForm(ArgumentType::class, $argument);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash(
                'success',
                " '{$argument->getTitle()}' a bien été modifié !"
            );

            return $this->redirectToRoute('admin_arguments_index');
        }

        return $this->render('admin/content/arguments/edit.html.twig', [
            'argument' => $argument,
            'form' => $form->createView()
        ]);
    }

}
