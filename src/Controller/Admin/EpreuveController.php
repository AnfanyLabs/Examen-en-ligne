<?php

namespace App\Controller\Admin;

use App\Entity\Epreuve;
use App\Entity\Utilisateur;
use App\Form\EpreuveType;
use App\Repository\EpreuveRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ENSEIGNANT')]

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
        $utilisateur =  $this->getUser();
        $epreuve->setUtilisateur($utilisateur);
        $form = $this->createForm(EpreuveType::class, $epreuve);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManagerInterface->persist($epreuve);
            $entityManagerInterface->flush();
           return $this->redirectToRoute('app_admin_epreuve_index', ['id'=>$epreuve->getId()]);
        
        }
        
        return $this->render('admin/epreuve/create.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/admin/epreuve/{id}/list', name: 'app_admin_discipline_list_by_user', requirements:['id'=>'\d+'])]
    public function findEpreuveByUser(? Utilisateur $utilisateur, EpreuveRepository $epreuveRepository): Response
    {
        $epreuves = $epreuveRepository->findByEpreuveByUser($utilisateur->getId()); 

         return $this->render('admin/epreuve/listByUser.html.twig', [
            'epreuves' => $epreuves,
        ]);
    }

    #[Route('/admin/epreuve/{id}/toggle-statut', name: 'admin_epreuve_toggle_isPublished',  requirements:['id'=>'\d+'])]
    
    public function toggleStatut(Epreuve $epreuve, EntityManagerInterface $em): Response
    {
        $epreuve->setIsPublished(!$epreuve->isPublished()); // inverse le statut
        $em->flush();

        return $this->redirectToRoute('app_admin_discipline_list_by_user', ['id'=>($this->getUser())->getId()]); // ou la route que tu veux
    }

    
}
