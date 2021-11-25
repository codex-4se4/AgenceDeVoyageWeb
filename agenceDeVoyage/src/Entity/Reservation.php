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
    private $title;


    private $discription;

    /**
     * @ORM\Column(type="date")
     */
    private $contratdebut;

    /**
     * @ORM\Column(type="date")
     */
    private $contratfin;

    /**
     * @ORM\OneToMany(targetEntity=Objet::class, mappedBy="objet")
     */
    private $type;

    
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

    /**
     * @return Collection|Objet[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Objet $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
            $type->setObjet($this);
        }

        return $this;
    }

    public function removeType(Objet $type): self
    {
        if ($this->type->removeElement($type)) {
            // set the owning side to null (unless already changed)
            if ($type->getObjet() === $this) {
                $type->setObjet(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getClient(): Collection
    {
        return $this->client;
    }

    public function addClient(Utilisateur $client): self
    {
        if (!$this->client->contains($client)) {
            $this->client[] = $client;
            $client->setUtilisateur($this);
        }

        return $this;
    }

    public function removeClient(Utilisateur $client): self
    {
        if ($this->client->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getUtilisateur() === $this) {
                $client->setUtilisateur(null);
            }
        }

        return $this;
    }
}