<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CircuitRepository::class)
 */
class Circuit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez saisir une description.")
     * @Assert\Length(
     *      min = 20,
     *      max = 255,
     *      minMessage = "La description doit contenir au minimum {{ limit }} caractères.",
     *      maxMessage = "La description doit contenir au maximum {{ limit }} caractères."
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank(message="Veuillez saisir un titre.")
     * @Assert\Length(
     *      min = 10,
     *      max = 80,
     *      minMessage = "Le titre doit contenir au minimum {{ limit }} caractères.",
     *      maxMessage = "Le titre doit contenir au maximum {{ limit }} caractères."
     * )
     */
    private $titre;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank(message="Veuillez saisir un prix.")
     * @Assert\Positive(message="Le prix doit être positif.")
     */
    private $prix;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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
}
