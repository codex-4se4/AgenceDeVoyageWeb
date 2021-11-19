<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
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
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $idr;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $objet;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $discription;

    /**
     * @ORM\Column(type="date")
     */
    private $contratdebut;

    /**
     * @ORM\Column(type="date")
     */
    private $contratfin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIdr(): ?int
    {
        return $this->idr;
    }

    public function setIdr(int $idr): self
    {
        $this->idr = $idr;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(?string $discription): self
    {
        $this->discription = $discription;

        return $this;
    }

    public function getContratdebut(): ?\DateTimeInterface
    {
        return $this->contratdebut;
    }

    public function setContratdebut(\DateTimeInterface $contratdebut): self
    {
        $this->contratdebut = $contratdebut;

        return $this;
    }

    public function getContratfin(): ?\DateTimeInterface
    {
        return $this->contratfin;
    }

    public function setContratfin(\DateTimeInterface $contratfin): self
    {
        $this->contratfin = $contratfin;

        return $this;
    }
}