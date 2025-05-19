<?php

namespace App\Entity;

use App\Repository\CopieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CopieRepository::class)]
class Copie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: "Le contenu ne doit pas être vide.")]
    #[Assert\Length(
        min: 10,
        minMessage: "Le contenu doit faire au moins {{ limit }} caractères.",
        max: 10000,
        maxMessage: "Le contenu ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $contenu = null;

    #[ORM\ManyToOne(inversedBy: 'copies')]
    #[Assert\NotNull(message: "L'examen est requis.")]
    private ?Examen $idExamen = null;

    #[ORM\ManyToOne(inversedBy: 'copies')]
    #[Assert\NotNull(message: "L'utilisateur est requis.")]
    private ?Utilisateur $idUtilisateur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getIdExamen(): ?Examen
    {
        return $this->idExamen;
    }

    public function setIdExamen(?Examen $idExamen): static
    {
        $this->idExamen = $idExamen;

        return $this;
    }

    public function getIdUtilisateur(): ?Utilisateur
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?Utilisateur $idUtilisateur): static
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }
}
