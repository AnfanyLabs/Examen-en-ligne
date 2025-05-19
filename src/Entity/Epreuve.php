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


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: "La date de l'épreuve est obligatoire.")]
    #[Assert\Date(message: "La date doit être valide.")]
    private ?\DateTime $dateEpreuve = null;

    #[ORM\Column(type: 'time')]
    #[Assert\NotBlank(message: "L'heure de début est obligatoire.")]
    #[Assert\Time(message: "L'heure de début doit être valide.")]
    private ?\DateTimeInterface $heureDebut = null;




    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "La durée est obligatoire.")]
    #[Assert\Positive(message: "La durée doit être exprimée en secondes et être positive.")]
    private ?\DateTime $dureeEpreuve = null;

    // Relation avec les questions (OneToMany)
    #[ORM\OneToMany(mappedBy: 'epreuve', targetEntity: Question::class)]
    private iterable $questions;


    public function __construct()
    {
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

    public function setDateEpreuve(\DateTime $date): static
    {
        $this->dateEpreuve = $date;

        return $this;
    }

    public function getHeureDebut(): ?\DateTime
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(\DateTime $heureDebut): static
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    public function getDuree(): ?\DateTime
    {
        return $this->dureeEpreuve;
    }

    public function setDuree(\DateTime $dureeEpreuve): static
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
    
}
