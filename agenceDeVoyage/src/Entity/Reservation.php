<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
    private $contratdebut;

    /**
     * @ORM\Column(type="date")
     */
    private $contratfin;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="reservation")
     */
    private $utilisateur;

    /**
     * @ORM\OneToOne(targetEntity=Objet::class, inversedBy="reservation", cascade={"persist", "remove"})
     */
    private $objet;

    public function __construct()
    {
        $this->Client = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;

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

    /**
     * @return Collection|Utilisateur[]
     */
    public function getClient(): Collection
    {
        return $this->Client;
    }

    public function addutilisateur(Utilisateur $utilisateur): self
    {
        if (!$this->utilisateur->contains($client)) {
            $this->utilisateur[] = $client;
            $client->setReservation($this);
        }

        return $this;
    }

    public function removeutilisateur(Utilisateur $client): self
    {
        if ($this->Client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getReservation() === $this) {
                $client->setReservation(null);
            }
        }

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
}
