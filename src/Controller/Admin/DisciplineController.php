<?php

namespace App\Controller\Admin;

use App\Entity\Discipline;
use App\Form\DisciplineType;
use App\Repository\DisciplineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DisciplineController extends AbstractController
{
    #[Route('/admin/discipline/liste', name: 'app_admin_discipline_list')]
    public function index(DisciplineRepository $disciplineRepository): Response
    {
        $disciplines = $disciplineRepository->findAll();
        return $this->render('admin/discipline/index.html.twig', [
            'disciplines' => $disciplines,
        ]);
    }

    #[Route('/admin/discipline/create', name: 'app_admin_create_discipline')]
    public function create(? Discipline $discipline, Request $request, EntityManagerInterface $entityManagerInterface): Response
    {
        $discipline = new Discipline();
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $entityManagerInterface->persist($discipline);
            $entityManagerInterface->flush();
           return $this->redirectToRoute('app_admin_discipline_list', ['id'=>$discipline->getId()]);
        
        }
        return $this->render('admin/discipline/create.html.twig', [
            'form'=>$form,
        ]);
    }

    
}
