<?php

namespace App\Entity;

use App\Repository\EspacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EspacesRepository::class)]
class Espaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $superficie = null;

    #[ORM\OneToMany(mappedBy: 'Espaces', targetEntity: Enclos::class, orphanRemoval: true)]
    private Collection $enclos;

    public function __construct()
    {
        $this->Enclos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Enclos>
     */
    public function getEnclos(): Collection
    {
        return $this->enclos;
    }

    public function addEnclo(Enclos $enclo): self
    {
        if (!$this->enclos->contains($enclo)) {
            $this->enclos->add($enclo);
            $enclo->setEnclos($this);
        }

        return $this;
    }

    public function removeEnclo(Enclos $enclo): self
    {
        if ($this->enclos->removeElement($enclo)) {
            // set the owning side to null (unless already changed)
            if ($enclo->getEnclos() === $this) {
                $enclo->setEnclos(null);
            }
        }

        return $this;
    }
}
