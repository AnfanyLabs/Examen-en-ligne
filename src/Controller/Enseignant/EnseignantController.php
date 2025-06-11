<?php

namespace App\Controller\Enseignant;

use App\Entity\Epreuve;
use App\Entity\Reponse;
use App\Form\CopieCorrectionTypeForm;
use App\Form\ReponseTypeForm;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ENSEIGNANT')]

final class EnseignantController extends AbstractController
{
    

}
