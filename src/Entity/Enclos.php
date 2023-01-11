<?php

namespace App\Entity;

use App\Repository\EnclossRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnclossRepository::class)]
class Enclos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $espaceIn = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $superficie = null;

    #[ORM\Column]
    private ?int $maxAnimaux = null;

    #[ORM\Column(length: 10)]
    private ?string $quarantaines = null;

    #[ORM\ManyToOne(inversedBy: 'Enclos')]
    #[ORM\JoinColumn(onDelete: 'CASCADE')]
    private ?Espaces $Espaces = null;

    #[ORM\OneToMany(mappedBy: 'Enclos', targetEntity: Animaux::class)]
    private Collection $Animaux;

    public function __construct()
    {
        $this->Animaux = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEspaceIn(): ?string
    {
        return $this->espaceIn;
    }

    public function setEspaceIn(string $espaceIn): self
    {
        $this->espaceIn = $espaceIn;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getSuperficie(): ?string
    {
        return $this->superficie;
    }

    public function setSuperficie(string $superficie): self
    {
        $this->superficie = $superficie;

        return $this;
    }

    public function getMaxAnimaux(): ?int
    {
        return $this->maxAnimaux;
    }

    public function setMaxAnimaux(int $maxAnimaux): self
    {
        $this->maxAnimaux = $maxAnimaux;

        return $this;
    }

    public function getQuarantaines(): ?string
    {
        return $this->quarantaines;
    }

    public function setQuarantaines(string $quarantaines): self
    {
        $this->quarantaines = $quarantaines;

        return $this;
    }

    public function getEspaces(): ?Espaces
    {
        return $this->Espaces;
    }

    public function setEspaces(?Espaces $Espaces): self
    {
        $this->Espaces = $Espaces;

        return $this;
    }

    /**
     * @return Collection<int, Animaux>
     */
    public function getAnimaux(): Collection
    {
        return $this->Animaux;
    }

    public function addAnimaux(Animaux $animaux): self
    {
        if (!$this->Animaux->contains($animaux)) {
            $this->Animaux->add($animaux);
            $animaux->setEnclos($this);
        }

        return $this;
    }

    public function removeAnimaux(Animaux $animaux): self
    {
        if ($this->Animaux->removeElement($animaux)) {
            // set the owning side to null (unless already changed)
            if ($animaux->getEnclos() === $this) {
                $animaux->setEnclos(null);
            }
        }

        return $this;
    }



}
