<?php

namespace App\Entity;

use App\Repository\MaisonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MaisonRepository::class)
 */
class Maison extends Hebergement {

    /**
     * @ORM\Column(type="float")
     */
    private $surfaceJardin;

    public function getSurfaceJardin(): ?float
    {
        return $this->surfaceJardin;
    }

    public function setSurfaceJardin(float $surfaceJardin): self
    {
        $this->surfaceJardin = $surfaceJardin;

        return $this;
    }
}
