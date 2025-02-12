<?php
namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $lieu = null;

    #[ORM\Column(length: 255)] // Correction ici
    private ?string $description = null;


    #[ORM\ManyToOne(targetEntity: Guide::class, inversedBy: "evenements")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Guide $guide = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?int $place_max = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column]
    private ?string  $status = null;
public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    #[ORM\Column]
    private ?bool $inetresse = null;

    #[ORM\OneToMany(mappedBy: "evenement", targetEntity: Commentaire::class, cascade: ["persist", "remove"])]
    private Collection $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): static
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getDescription(): ?string
{
    return $this->description;
}

public function setDescription(?string $description): static
{
    $this->description = $description;
    return $this;
}
    public function getGuide(): ?Guide
    {
        return $this->guide;
    }

    public function setGuide(?Guide $guide): static
    {
        $this->guide = $guide;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    public function getPlaceMax(): ?int
    {
        return $this->place_max;
    }

    public function setPlaceMax(int $place_max): static
    {
        $this->place_max = $place_max;
        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;
        return $this;
    }

    public function isInetresse(): ?bool
    {
        return $this->inetresse;
    }

    public function setInetresse(bool $inetresse): static
    {
        $this->inetresse = $inetresse;
        return $this;
    }

    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setEvenement($this);
        }
        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->commentaires->removeElement($commentaire)) {
            if ($commentaire->getEvenement() === $this) {
                $commentaire->setEvenement(null);
            }
        }
        return $this;
    }
}
