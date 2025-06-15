<?php
namespace App\Controller\Candidat;

use App\Entity\Epreuve;
use App\Entity\Reponse;
use App\Form\ReponseTypeForm;
use App\Repository\EpreuveRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_CANDIDAT')]
final class CandidatController extends AbstractController
{
    #[Route('/admin_home', name: 'candidat_home')]
    public function index(): Response
    {
        return $this->render('candidat/index.html.twig', [

        ]);
    }

     #[Route('/epreuves', name: 'app_epreuve_candidat')]
    public function epreuveAcomposer(EpreuveRepository $epreuveRepository): Response
    {
        $user = $this->getUser();
        $epreuves =$epreuveRepository->epreuveForCandidat($user->getClasse()); 
        return $this->render('candidat/epreuves.html.twig', [
            'epreuves' => $epreuves,
        ]);
    }



    #[Route('/candidat_epreuves/{id}', name: 'epreuve_exam_candidat', requirements:['id'=>'\d+'])]
    public function passerEpreuve(? Epreuve $epreuve, Request $request, EntityManagerInterface $entityManager): Response
    {
        $epreuve =   $entityManager->getRepository(Epreuve::class)->find($epreuve->getId()); 
        $utilisateur = $this->getUser();
        $reponse = new Reponse();
        $form = $this->createForm(ReponseTypeForm::class, $reponse, ['epreuve'=> $epreuve]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reponse);
            $entityManager->flush();
           return $this->redirectToRoute('epreuve_exam_candidat', ['id'=>$epreuve->getId()]);
       
        }
        return $this->render('candidat/copie.html.twig', [
            'epreuve' => $epreuve,
            'form' => $form
        ]);
    }

}
