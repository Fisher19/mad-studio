<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     *
     * @var ServiceRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(ServiceRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * Permet d'afficher les différents services
     * 
     * @Route("/admin", name="admin.prestations.index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $services = $this->repository->findAll();

        return $this->render('admin/prestations/index.html.twig', [
            'services' => $services,
        ]);
    }

    /**
     * Permet de créer un nouveau service
     * 
     * @Route("/admin/service/create", name="admin.prestations.new")
     *
     * @return void
     */
    public function new(Request $request) {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($service);
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le service '{$service->getTitle()}' a bien été créé !"
            );

            return $this->redirectToRoute('admin.prestations.index');
        }

        return $this->render('admin/prestations/new.html.twig', [
            'service' => $service,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer les différents services
     * 
     * @Route("/admin/service/{id}/edit", name="admin.prestations.edit")
     * 
     * @param Service $service
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Service $service, Request $request)
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash(
                'success',
                "Le service '{$service->getTitle()}' a bien été modifié !"
            );

            return $this->redirectToRoute('admin.prestations.index');
        }

        return $this->render('admin/prestations/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer un service
     *
     * @Route("/admin/service/{id}/delete", name="admin.prestations.delete", methods="DELETE")
     * 
     * @param Service $service
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Service $service, Request $request, EntityManagerInterface $manager) {
        if ($this->isCsrfTokenValid('delete' . $service->getId(), $request->get('_token'))) {
            $manager->remove($service);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le service '{$service->getTitle()}' a bien été supprimé !"
            );
        }
        return $this->redirectToRoute('admin.prestations.index');
    }

}
