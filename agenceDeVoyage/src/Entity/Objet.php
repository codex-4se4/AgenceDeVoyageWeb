<?php

namespace App\Entity;

use App\Repository\ObjetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjetRepository::class)
 */
class Objet
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
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity=Reservation::class, mappedBy="objet", cascade={"persist", "remove"})
     */
    private $reservation;

    /**
     * @ORM\ManyToOne(targetEntity=Reservation::class, inversedBy="type")
     * @ORM\JoinColumn(nullable=false)
     */
    private $objet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        // unset the owning side of the relation if necessary
        if ($reservation === null && $this->reservation !== null) {
            $this->reservation->setObjet(null);
        }

        // set the owning side of the relation if necessary
        if ($reservation !== null && $reservation->getObjet() !== $this) {
            $reservation->setObjet($this);
        }

        $this->reservation = $reservation;

        return $this;
    }

    public function getObjet(): ?Reservation
    {
        return $this->objet;
    }

    public function setObjet(?Reservation $objet): self
    {
        $this->objet = $objet;

        return $this;
    }
}
