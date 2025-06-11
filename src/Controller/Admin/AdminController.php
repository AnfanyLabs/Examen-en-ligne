<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;



final class AdminController extends AbstractController
{
    #[Route('/admin_home', name: 'admin_home')]
    public function index(UtilisateurRepository $utilisateurRepository ): Response
    {
         $userNotAuthorized = $utilisateurRepository->findUserNotAuthorized();
        return $this->render('admin/index.html.twig', [
           'userNotAuthorized' => $userNotAuthorized,
        ]);
    }

    /**
     * User signing up list
     */
    #[IsGranted('ROLE_ADMIN')]
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
    #[IsGranted('ROLE_ADMIN')]
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
    #[IsGranted('ROLE_ADMIN')]
     #[Route('/admin/candidats_list', name: 'admin_candidats_validated')]
    
    public function list_candidat_authorized(UtilisateurRepository $utilisateurRepository): Response
    {
       $candidatsAuthorized = $utilisateurRepository->findCandidatesAuthorized();

       return $this->render('admin/utilisateur/authorizedCandidates.html.twig', [
            'candidatsAuthorized' => $candidatsAuthorized,
       ]);
    }
    
    #[IsGranted('ROLE_ADMIN')]
     #[Route('/admin/enseignants_list', name: 'admin_enseignants_validated')]
    
    public function list_enseignant_authorized(UtilisateurRepository $utilisateurRepository): Response
    {
       $enseignantsAuthorized = $utilisateurRepository->findEnseignantsAuthorized();

       return $this->render('admin/utilisateur/authorizedEnseignants.html.twig', [
            'enseignantsAuthorized' => $enseignantsAuthorized,
       ]);
    }
}
