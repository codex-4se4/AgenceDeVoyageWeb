<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Vehicule
 *
 * @ORM\Table(name="vehicule")
 * @ORM\Entity
 */
class Vehicule
{
    /**
     * @var int
     *
     * @ORM\Column(name="immatricule", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $immatricule;

    /**
     * @var string
     *
     * @ORM\Column(name="constructeur", type="string", length=100, nullable=false)
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     *     message="{{ value }} must be String "
     * )
     * @Assert\NotBlank(message="Must be filled")
     */
    private $constructeur;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=100, nullable=false)
     * @Assert\Regex(
     *     pattern     = "/^[a-z]+$/i",
     *     htmlPattern = "^[a-zA-Z]+$",
     *     message="{{ value }} must be String "
     * )
     * @Assert\NotBlank(message="Must be filled")
     */
    private $marque;

    /**
     * @var int
     *
     * @ORM\Column(name="etat", type="integer", nullable=false)
     * @Assert\Positive(message="Must Be upper than 0")
     * @Assert\NotBlank(message="Must be filled")
     * @Assert\Regex(
     *     pattern     = "/^[0-9]*$/",
     *     htmlPattern = "^[0-9]*$",
     *      message="{{ value }} must be a Number"
     * )
     */
    private $etat;

    public function getImmatricule(): ?int
    {
        return $this->immatricule;
    }

    public function getConstructeur(): ?string
    {
        return $this->constructeur;
    }

    public function setConstructeur(string $constructeur): self
    {
        $this->constructeur = $constructeur;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getEtat(): ?int
    {
        return $this->etat;
    }

    public function setEtat(int $etat): self
    {
        $this->etat = $etat;

        return $this;
    }


}
