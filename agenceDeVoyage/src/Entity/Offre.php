<?php

namespace App\Entity;

use App\Repository\OffreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OffreRepository::class)
 */
class Offre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $TypeOffre;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;

    /**
     * @ORM\Column(type="date")
     */
    private $DebutOffre;

    /**
     * @ORM\Column(type="date")
     */
    private $FinOffre;

    /**
     * @ORM\ManyToOne(targetEntity=Partenariat::class, inversedBy="offres")
     */
    private $Partenariat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOffre(): ?string
    {
        return $this->TypeOffre;
    }

    public function setTypeOffre(string $TypeOffre): self
    {
        $this->TypeOffre = $TypeOffre;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDebutOffre(): ?\DateTimeInterface
    {
        return $this->DebutOffre;
    }

    public function setDebutOffre(\DateTimeInterface $DebutOffre): self
    {
        $this->DebutOffre = $DebutOffre;

        return $this;
    }

    public function getFinOffre(): ?\DateTimeInterface
    {
        return $this->FinOffre;
    }

    public function setFinOffre(\DateTimeInterface $FinOffre): self
    {
        $this->FinOffre = $FinOffre;

        return $this;
    }

    public function getPartenariat(): ?Partenariat
    {
        return $this->Partenariat;
    }

    public function setPartenariat(?Partenariat $Partenariat): self
    {
        $this->Partenariat = $Partenariat;

        return $this;
    }
}
