<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;


    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Le titre de la question est obligatoire.")]
    private ?string $titre = null;


    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Le type de la question est obligatoire.")]
    private ?string $type = null;


    #[ORM\Column()]
    #[Assert\NotBlank(message: "Le contenu de la question est obligatoire.")]
    private ?string $contenu = null;
   

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: "Le nombre de points est obligatoire.")]
    #[Assert\Positive(message: "Le nombre de points doit être positif.")]
    private ?int $points = null;

    // Relation ManyToOne vers Epreuve
    #[ORM\ManyToOne(targetEntity: Epreuve::class, inversedBy: 'questions')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotNull(message: "L'épreuve associée est obligatoire.")]
    private ?Epreuve $epreuve = null;

    // Getters & Setters

    public function getid(): ?int
    {
        return $this->id;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
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

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(int $points): self
    {
        $this->points = $points;
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
}
