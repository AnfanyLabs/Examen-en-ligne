<?php

namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: "L'email est obligatoire.")]
    #[Assert\Email(message: "Le format de l'email n'est pas valide.")]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\Length(
        min: 5,
        minMessage:"Le mot de passe doit dépasser {{limit}} caractères."
    )]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min:3,
        max: 100,
        minMessage:"Le nom doit dépasser {{ limit }} caractères.",
        maxMessage: "Le nom ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\Length(
        min:3,
        max: 100,
        minMessage:"Le prénom doit dépasser {{ limit }} caractères.",
        maxMessage: "Le prénom ne peut pas dépasser {{ limit }} caractères."
    )]
    private ?string $prenom = null;


    #[ORM\Column]
    private ?string $statut = null;


    /**
     * @var Collection<int, Copie>
     */
    #[ORM\OneToMany(targetEntity: Copie::class, mappedBy: 'idUtilisateur')]
    private  ? Collection $copies;

    #[ORM\ManyToOne(inversedBy: 'utilisateurs')]
    #[ORM\JoinColumn(name: 'classe_id', referencedColumnName: 'id', nullable: true)]
    private ?Classe $classe = null;

    public function __construct()
    {
        $this->copies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
 
        public function setRoles(array|string $roles): self
    {
        // Si c'est une chaîne (ex: depuis le formulaire), on la met dans un tableau
        $this->roles = is_array($roles) ? $roles : [$roles];

        return $this;
    }
   
    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function isStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): static
    {
        $this->statut = $statut;

        return $this;
    }


    public function isActive():bool{
       return  $this->statut ==='actif';
    }


    /**
     * @return Collection<int, Copie>
     */
    public function getCopies(): Collection
    {
        return $this->copies;
    }

    public function addCopy(Copie $copy): static
    {
        if (!$this->copies->contains($copy)) {
            $this->copies->add($copy);
            $copy->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeCopy(Copie $copy): static
    {
        if ($this->copies->removeElement($copy)) {
            // set the owning side to null (unless already changed)
            if ($copy->getIdUtilisateur() === $this) {
                $copy->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    public function getclasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $Classe): static
    {
        $this->classe = $Classe;

        return $this;
    }
}
