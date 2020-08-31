<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/admin/prestations", name="admin_prestations_index")
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
     * @Route("/admin/prestations/create", name="admin_prestations_new")
     *
     * @return void
     */
    public function new(Request $request) {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
             // On récupère les images transmises
             $images = $form->get('images')->getData();

             // On boucle sur les images
             foreach($images as $image){
                 // On génère un nouveau nom de fichier
                 $fichier = md5(uniqid()) . '.' . $image->guessExtension();
 
                 // On copie le fichier dans le dossier uploads
                 $image->move(
                     $this->getParameter('images_directory'),
                     $fichier
                 );
 
                 // On stocke l'image dans la base de données (son nom)
                 $img = new Images();
                 $img->setName($fichier);
                 $service->addImage($img);
             }

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
     * @Route("/admin/prestations/{id}/edit", name="admin_prestations_edit")
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
            // On récupère les images transmises
            $images = $form->get('images')->getData();

            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()) . '.' . $image->guessExtension();
            
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
            
                // On stocke l'image dans la base de données (son nom)
                $img = new Images();
                $img->setName($fichier);
                $service->addImage($img);
            }
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
     * @Route("/admin/prestations/{id}/delete", name="admin_prestations_delete", methods="DELETE")
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

    /**
     * @Route("/supprime/image/{id}", name="prestations_delete_image", methods={"DELETE"})
     */
    public function deleteImage(Images $image, Request $request){
        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $nom = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);
            $em->flush();

            // On répond en json
            return new JsonResponse(['success' => 1]);
        }else{
            return new JsonResponse(['error' => 'Token Invalide'], 400);
        }
    }

}
