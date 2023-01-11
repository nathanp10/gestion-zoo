<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animaux
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $animaux = null;

    #[ORM\Column(type: Types::BIGINT)]
    private ?string $NID = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $arrive = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $depart = null;

    #[ORM\Column(length: 10)]
    private ?string $proprietaire = null;

    #[ORM\Column(length: 255)]
    private ?string $Genre = null;

    #[ORM\Column(length: 255)]
    private ?string $espece = null;

    #[ORM\Column(length: 255)]
    private ?string $MF_ND = null;

    #[ORM\Column(length: 10)]
    private ?string $sterilise = null;

    #[ORM\Column(length: 10)]
    private ?string $quarantaine = null;

    #[ORM\ManyToOne(inversedBy: 'Animaux')]
    private ?Enclos $Enclos = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnimaux(): ?string
    {
        return $this->animaux;
    }

    public function setAnimaux(string $animaux): self
    {
        $this->animaux = $animaux;

        return $this;
    }

    public function getNID(): ?string
    {
        return $this->NID;
    }

    public function setNID(string $NID): self
    {
        $this->NID = $NID;

        return $this;
    }

    public function getArrive(): ?\DateTimeInterface
    {
        return $this->arrive;
    }

    public function setArrive(\DateTimeInterface $arrive): self
    {
        $this->arrive = $arrive;

        return $this;
    }

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->depart;
    }

    public function setDepart(?\DateTimeInterface $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getProprietaire(): ?string
    {
        return $this->proprietaire;
    }

    public function setProprietaire(string $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->Genre;
    }

    public function setGenre(string $Genre): self
    {
        $this->Genre = $Genre;

        return $this;
    }

    public function getEspece(): ?string
    {
        return $this->espece;
    }

    public function setEspece(string $espece): self
    {
        $this->espece = $espece;

        return $this;
    }

    public function getMFND(): ?string
    {
        return $this->MF_ND;
    }

    public function setMFND(string $MF_ND): self
    {
        $this->MF_ND = $MF_ND;

        return $this;
    }

    public function getSterilise(): ?string
    {
        return $this->sterilise;
    }

    public function setSterilise(string $sterilise): self
    {
        $this->sterilise = $sterilise;

        return $this;
    }

    public function getQuarantaine(): ?string
    {
        return $this->quarantaine;
    }

    public function setQuarantaine(string $quarantaine): self
    {
        $this->quarantaine = $quarantaine;

        return $this;
    }

    public function getEnclos(): ?Enclos
    {
        return $this->Enclos;
    }

    public function setEnclos(?Enclos $Enclos): self
    {
        $this->Enclos = $Enclos;

        return $this;
    }
}
