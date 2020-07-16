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

class AdminServiceController extends AbstractController
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
     * @Route("/admin/content/prestations", name="admin_prestations_index")
     * @return Response
     */
    public function index()
    {
        $services = $this->repository->findAll();

        return $this->render('admin/content/prestations/index.html.twig', [
            'services' => $services,
        ]);
    }

    /**
     * Permet de créer un nouveau service
     * 
     * @Route("/admin/content/prestations/create", name="admin_prestations_new")
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

            return $this->redirectToRoute('admin_prestations_index');
        }

        return $this->render('admin/content/prestations/new.html.twig', [
            'service' => $service,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet d'éditer les différents services
     * 
     * @Route("/admin/content/prestations/{id}/edit", name="admin_prestations_edit")
     * 
     * @param Service $service
     * @param Request $request
     * @return Response
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

            return $this->redirectToRoute('admin_prestations_index');
        }

        return $this->render('admin/content/prestations/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView()
        ]);
    }

    /**
     * Permet de supprimer un service
     *
     * @Route("/admin/content/prestations/{id}/delete", name="admin_prestations_delete", methods="DELETE")
     * 
     * @param Service $service
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
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
        return $this->redirectToRoute('admin_prestations_index');
    }

}
