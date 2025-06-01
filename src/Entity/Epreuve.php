<?php

namespace App\Entity;

use App\Repository\EpreuveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EpreuveRepository::class)]
class Epreuve
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message:"Un nom est requis")]
    #[Assert\Length(
        min: 5,
        minMessage: "Le nom doit faire au moins {{ limit }} caractères.",
        max: 100,
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $nom = null;

    #[ORM\Column]
    #[Assert\NotBlank(message:"Le coefficient est obligatoire")]
    #[Assert\Positive(message:"Le coefficient doit être un nombre positif")]
    private ?int $coefficient = null;


    #[ORM\Column()]
    #[Assert\NotBlank(message: "La date de l'épreuve est obligatoire.")]
    private ?\DateTimeImmutable $dateEpreuve = null;


    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "La durée est obligatoire.")]
    #[Assert\Positive(message: "La durée doit être exprimée en secondes et être positive.")]
    private ? int $dureeEpreuve = null;

    // Relation avec les questions (OneToMany)
    #[ORM\OneToMany(mappedBy: 'epreuve', targetEntity: Question::class, cascade:['persist'], orphanRemoval:true)]
    #[Assert\Valid()]
    private Collection $questions;

    #[ORM\ManyToOne(inversedBy: 'epreuves')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Discipline $discipline = null;

    #[ORM\ManyToOne(inversedBy: 'epreuves')]
    private ?Classe $classe = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contexte = null;

    #[ORM\Column(type: 'boolean', options:['default'=>false])]
    private ?bool $isPublished = null;


    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCoefficient(): ?int
    {
        return $this->coefficient;
    }

    public function setCoefficient(int $coefficient): static
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    public function getDateEpreuve(): ?\DateTime
    {
        return $this->dateEpreuve;
    }

    public function setDateEpreuve(\DateTimeImmutable $date): static
    {
        $this->dateEpreuve = $date;

        return $this;
    }


    public function getDureeEpreuve(): int
    {
        return $this->dureeEpreuve;
    }

    public function setDureeEpreuve(int  $dureeEpreuve): static
    {
        $this->dureeEpreuve = $dureeEpreuve;

        return $this;
    }

        public function getQuestions(): iterable
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): self
    {
        if (!$this->questions->contains($question)) {
            $this->questions[] = $question;
            $question->setEpreuve($this);
        }
        return $this;
    }

    public function getDiscipline(): ?Discipline
    {
        return $this->discipline;
    }

    public function setDiscipline(?Discipline $discipline): static
    {
        $this->discipline = $discipline;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    public function getContexte(): ?string
    {
        return $this->contexte;
    }

    public function setContexte(?string $contexte): static
    {
        $this->contexte = $contexte;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): static
    {
        $this->isPublished = $isPublished;

        return $this;
    }
    
}
