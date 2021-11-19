<?php

namespace App\Entity;

use App\Repository\MaisonHoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaisonHoteRepository::class)
 */
class MaisonHote extends Hebergement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $avecPetitDejInclus;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvecPetitDejInclus(): ?bool
    {
        return $this->avecPetitDejInclus;
    }

    public function setAvecPetitDejInclus(bool $avecPetitDejInclus): self
    {
        $this->avecPetitDejInclus = $avecPetitDejInclus;

        return $this;
    }
}
