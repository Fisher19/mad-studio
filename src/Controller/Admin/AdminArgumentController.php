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
     * @Route("/admin/arguments", name="admin_arguments_index")
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
     * Permet de créer un nouvel argument
     * 
     * @Route("/admin/content/arguments/create", name="admin_arguments_new")
     *
     * @return void
     */
    public function new(Request $request) {
        $argument = new Argument();
        $form = $this->createForm(argumentType::class, $argument);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($argument);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le argument '{$argument->getTitle()}' a bien été créé !"
            );

            return $this->redirectToRoute('admin_arguments_index');
        }

        return $this->render('admin/content/arguments/new.html.twig', [
            'argument' => $argument,
            'form' => $form->createView()
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

    /**
     * Permet de supprimer un argument
     *
     * @Route("/admin/content/arguments/{id}/delete", name="admin_arguments_delete", methods="DELETE")
     * 
     * @param Argument $argument
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     */
    public function delete(Argument $argument, Request $request, EntityManagerInterface $manager) {
        if ($this->isCsrfTokenValid('delete' . $argument->getId(), $request->get('_token'))) {
            $manager->remove($argument);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le argument '{$argument->getTitle()}' a bien été supprimé !"
            );
        }
        return $this->redirectToRoute('admin_arguments_index');
    }

}
