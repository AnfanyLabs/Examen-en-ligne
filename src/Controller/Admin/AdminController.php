<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/admin_home', name: 'admin_home')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * User signing up list
     */
    #[Route(path: '/admin/inscription_en_attente', name: 'app_registration_waiting')]

    public function list_registration_waiting(UtilisateurRepository $utilisateurRepository): Response
    {
       $userNotAuthorized = $utilisateurRepository->findUserNotAuthorized();

       return $this->render('admin/utilisateur/waitAuthorizing.html.twig', [
            'userNotAuthorized' => $userNotAuthorized,
       ]);
    }

    /**
     * User signing up validating list
     */

    #[Route('/admin/utilisateur/{id}/toggle-statut', name: 'admin_utilisateur_toggle_statut')]
    
    public function toggleStatut(Utilisateur $utilisateur, EntityManagerInterface $em): Response
    {
        $utilisateur->setStatut(!$utilisateur->isStatut()); // inverse le statut
        $em->flush();

        return $this->redirectToRoute('app_registration_waiting'); // ou la route que tu veux
    }

    /**
     * User 
     */

     #[Route('/admin/candidats_list', name: 'admin_candidats_validated')]
    
    public function list_candidat_authorized(UtilisateurRepository $utilisateurRepository): Response
    {
       $candidatsAuthorized = $utilisateurRepository->findCandidatesAuthorized();

       return $this->render('admin/utilisateur/authorizedCandidates.html.twig', [
            'candidatsAuthorized' => $candidatsAuthorized,
       ]);
    }

     #[Route('/admin/enseignants_list', name: 'admin_enseignants_validated')]
    
    public function list_enseignant_authorized(UtilisateurRepository $utilisateurRepository): Response
    {
       $enseignantsAuthorized = $utilisateurRepository->findEnseignantsAuthorized();

       return $this->render('admin/utilisateur/authorizedEnseignants.html.twig', [
            'enseignantsAuthorized' => $enseignantsAuthorized,
       ]);
    }
}
