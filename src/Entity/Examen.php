<?php

namespace App\Entity;

use App\Repository\ExamenRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ExamenRepository::class)]
class Examen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le titre de l'examen est requis.")]
    #[Assert\Length(
        max: 255,
        maxMessage: "Le titre ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $titre = null;

    #[ORM\OneToMany(targetEntity: Epreuve::class, mappedBy: 'id')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "L'épreuve associée est requise.")]
    private ?Epreuve $epreuve = null;

    #[ORM\ManyToOne(targetEntity: Classe::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "La classe associée est requise.")]
    private ?Classe $classe = null;

    // Getters et Setters...

    public function getIdExamen(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;
        return $this;
    }

    public function getEpreuve(): ?Epreuve
    {
        return $this->epreuve;
    }

    public function setEpreuve(?Epreuve $epreuve): self
    {
        $this->epreuve = $epreuve;
        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): self
    {
        $this->classe = $classe;
        return $this;
    }
}