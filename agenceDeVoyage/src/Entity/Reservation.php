<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="contratdebut", columns={"contratdebut"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="contratfin", columns={"contratfin"}), @ORM\Index(name="objet_id", columns={"objet_id"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="contratfin", type="date", nullable=false)
     */
    private $contratfin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="contratdebut", type="date", nullable=false)
     */
    private $contratdebut;

    /**
     * @var \Objet
     *
     * @ORM\ManyToOne(targetEntity="Objet")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="objet_id", referencedColumnName="id")
     * })
     */
    private $objet;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getContratdebut(): ?\DateTimeInterface
    {
        return $this->contratdebut;
    }

    public function setContratdebut(\DateTimeInterface $contratdebut): self
    {
        $this->contratdebut = $contratdebut;

        return $this;
    }

    public function getObjet(): ?Objet
    {
        return $this->objet;
    }

    public function setObjet(?Objet $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->user;
    }

    public function setUser(?Utilisateur $user): self
    {
        $this->user = $user;

        return $this;
    }


}
