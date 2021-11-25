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
     * @ORM\Column(type="boolean")
     */
    private $avecPetitDejInclus;


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
