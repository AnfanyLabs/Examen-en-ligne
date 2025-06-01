<?php

namespace App\Controller\Candidat;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CandidatController extends AbstractController
{
    #[Route('/candidat_home', name: 'candidat_home')]
    public function index(): Response
    {
        return $this->render('candidat/index.html.twig', [

        ]);
    }
}
