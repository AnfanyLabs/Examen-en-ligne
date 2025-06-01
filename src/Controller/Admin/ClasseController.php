<?php

namespace App\Controller\Admin;

use App\Entity\Classe;
use App\Form\ClasseForm;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ClasseController extends AbstractController
{
    #[Route('/admin/classes', name: 'app_admin_classe')]
    public function index(ClasseRepository $classeRepository ): Response
    {   
        $classes = $classeRepository->findAll();
        return $this->render('admin/classe/index.html.twig', [
            'classes' => $classes,
        ]);
    }

    /**
     * Create a classroom for students
     * 
     */

    #[Route('/admin/create_class', name: 'app_admin_create_classe', methods:['GET', 'POST'])]
    #[Route('/admin/class/{id}/edit', name: 'app_admin_edit_classe', methods:['GET','POST'], requirements:['id'=>'\d+'])]
   
    public function create(? Classe $class, Request $request, EntityManagerInterface $entityManager):Response
    {

        $class ??= new Classe();
        $form = $this->createForm(ClasseForm::class, $class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($class);
            $entityManager->flush();
           return $this->redirectToRoute('app_admin_classe', ['id'=>$class->getId()]);
        }

        return $this->render('/admin/classe/create.html.twig', [
           'form' =>$form,
        ]);
    }

}
