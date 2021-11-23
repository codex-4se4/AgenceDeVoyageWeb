<?php

namespace App\Entity;

use App\Repository\AppartementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AppartementRepository::class)
 */
class Appartement extends Hebergement
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
    private $numeroEtage;

    /**
     * @ORM\Column(type="boolean")
     */
    private $avecAscenseur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroEtage(): ?int
    {
        return $this->numeroEtage;
    }

    public function setNumeroEtage(int $numeroEtage): self
    {
        $this->numeroEtage = $numeroEtage;

        return $this;
    }

    public function getAvecAscenseur(): ?bool
    {
        return $this->avecAscenseur;
    }

    public function setAvecAscenseur(bool $avecAscenseur): self
    {
        $this->avecAscenseur = $avecAscenseur;

        return $this;
    }
}
