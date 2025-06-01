<?php

namespace App\Controller\Admin;

use App\Entity\Epreuve;
use App\Form\EpreuveType;
use App\Repository\EpreuveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EpreuveController extends AbstractController
{
    #[Route('/admin/epreuve/list', name: 'app_admin_epreuve_index')]
    public function index(EpreuveRepository $epreuveRepository): Response
    {

        $epreuves = $epreuveRepository->findAll();


        return $this->render('admin/epreuve/index.html.twig', [
            'epreuves' => $epreuves,
        ]);
    }

    #[Route('/admin/epreuve/create', name: 'app_admin_create_epreuve')]
    public function create(Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $epreuve = new Epreuve();
        $form = $this->createForm(EpreuveType::class, $epreuve);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($epreuve);
            $entityManagerInterface->flush();
           return $this->redirectToRoute('app_admin_epreuve', ['id'=>$epreuve->getId()]);
        
        }
        
        return $this->render('admin/epreuve/create.html.twig', [
            'form' => $form,
        ]);
    }
}
