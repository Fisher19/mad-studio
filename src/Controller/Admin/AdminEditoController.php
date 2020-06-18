<?php

namespace App\Controller\Admin;

use App\Entity\Edito;
use App\Form\EditoType;
use App\Repository\EditoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminEditoController extends AbstractController
{
    /**
     *
     * @var EditoRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    public function __construct(EditoRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * Permet d'afficher l'edito
     * 
     * @Route("/admin/content/edito", name="admin_edito_index")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $edito = $this->repository->findAll();

        return $this->render('admin/content/edito/index.html.twig', [
            'edito' => $edito,
        ]);
    }


    /**
     * Permet d'éditer l'edito
     * 
     * @Route("/admin/content/edito/{id}/edit", name="admin_edito_edit")
     * 
     * @param Edito $edito
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Edito $edito, Request $request)
    {
        $form = $this->createForm(EditoType::class, $edito);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            $this->addFlash(
                'success',
                " '{$edito->getTitle()}' a bien été modifié !"
            );

            return $this->redirectToRoute('admin_edito_index');
        }

        return $this->render('admin/content/edito/edit.html.twig', [
            'edito' => $edito,
            'form' => $form->createView()
        ]);
    }

}
