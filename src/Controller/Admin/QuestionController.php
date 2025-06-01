<?php

namespace App\Controller\Admin;

use App\Entity\Epreuve;
use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\EpreuveRepository;
use App\Repository\QuestionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class QuestionController extends AbstractController
{
    #[Route('/admin/{id}/question', name: 'app_admin_epreuve_question',  requirements:['id'=>'\d+'])]
    public function create(EpreuveRepository $epreuveRepository,  Request $request, EntityManagerInterface $entityManager): Response
    {
        $epreuve = $epreuveRepository->find($request->get('id'));
        
        $question = new Question();
        $question->setEpreuve($epreuve);
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);
        $questions = $epreuve->getQuestions();

        

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($question);
            $entityManager->flush();
           return $this->redirectToRoute('app_admin_epreuve_question', ['id' => $epreuve->getId()]); 
        }

        return $this->render('admin/question/create.html.twig', [
            'form' => $form,
            'epreuve' => $epreuve,
            'questions' => $questions
        ]);
    }
}
