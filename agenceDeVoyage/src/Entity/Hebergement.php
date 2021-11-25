<?php

namespace App\Entity;

use App\Repository\HebergementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HebergementRepository::class)
 */
class Hebergement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbChambres;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPersonnes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $avecPiscine;

    /**
     * @ORM\Column(type="boolean")
     */
    private $avecParking;

    /**
     * @ORM\Column(type="boolean")
     */
    private $avecPlage;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $adresse;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbChambres(): ?int
    {
        return $this->nbChambres;
    }

    public function setNbChambres(int $nbChambres): self
    {
        $this->nbChambres = $nbChambres;

        return $this;
    }

    public function getNbPersonnes(): ?int
    {
        return $this->nbPersonnes;
    }

    public function setNbPersonnes(int $nbPersonnes): self
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }

    public function getAvecPiscine(): ?bool
    {
        return $this->avecPiscine;
    }

    public function setAvecPiscine(bool $avecPiscine): self
    {
        $this->avecPiscine = $avecPiscine;

        return $this;
    }

    public function getAvecParking(): ?bool
    {
        return $this->avecParking;
    }

    public function setAvecParking(bool $avecParking): self
    {
        $this->avecParking = $avecParking;

        return $this;
    }

    public function getAvecPlage(): ?bool
    {
        return $this->avecPlage;
    }

    public function setAvecPlage(bool $avecPlage): self
    {
        $this->avecPlage = $avecPlage;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }
}
