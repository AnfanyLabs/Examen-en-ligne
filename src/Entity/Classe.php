<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Assert\NotBlank(message: "Le nom de la classe est obligatoire")]
    #[Assert\Length(
        max: 100,
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $nom = null;


    /**
     * @var Collection<int, Utilisateur>
     */
    #[ORM\OneToMany(targetEntity: Utilisateur::class, mappedBy: 'idClasse')]
    private Collection $utilisateurs;

    /**
     * @var Collection<int, Examen>
     */
    #[ORM\OneToMany(targetEntity: Examen::class, mappedBy: 'idClasse')]
    private Collection $examens;

    public function __construct()
    {
        $this->utilisateurs = new ArrayCollection();
        $this->examens = new ArrayCollection();
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



    /**
     * @return Collection<int, Utilisateur>
     */
    public function getUtilisateurs(): Collection
    {
        return $this->utilisateurs;
    }

    public function addUtilisateur(Utilisateur $utilisateur): static
    {
        if (!$this->utilisateurs->contains($utilisateur)) {
            $this->utilisateurs->add($utilisateur);
            $utilisateur->setClasse($this);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateur $utilisateur): static
    {
        if ($this->utilisateurs->removeElement($utilisateur)) {
            // set the owning side to null (unless already changed)
            if ($utilisateur->getClasse() === $this) {
                $utilisateur->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Examen>
     */
    public function getExamens(): Collection
    {
        return $this->examens;
    }

    public function addExamen(Examen $examen): static
    {
        if (!$this->examens->contains($examen)) {
            $this->examens->add($examen);
            $examen->setClasse($this);
        }

        return $this;
    }

    public function removeExamen(Examen $examen): static
    {
        if ($this->examens->removeElement($examen)) {
            // set the owning side to null (unless already changed)
            if ($examen->getClasse() === $this) {
                $examen->setClasse(null);
            }
        }

        return $this;
    }

}
