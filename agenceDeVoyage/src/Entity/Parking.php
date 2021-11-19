<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Parking
 *
 * @ORM\Table(name="parking")
 * @ORM\Entity
 */
class Parking
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
     * @Assert\Date
     * @Assert\NotBlank(message="Must be filled")
     *  @Assert\GreaterThan("yesterday",
     *     message="must be greater than today")
     * @ORM\Column(name="date_sortie", type="date", nullable=false)
     */
    private $dateSortie;

    /**
     * @var int
     * @ORM\Column(name="id_voiture", type="integer", nullable=false)
     */
    private $idVoiture;

    /**
     * @var int
     * @Assert\Positive(message="Must Be upper than 0")
     * @Assert\NotBlank(message="Must be filled")
     * @ORM\Column(name="num_place", type="integer", nullable=false)
     */
    private $numPlace;

    /**
     * @var \DateTime
     * @Assert\Date
     * @Assert\Expression(
     *     "this.getDateSortie() < this.getDatePrevuRetour()",
     *     message="date retour must be greater than date sortie"
     * )
     * @Assert\NotBlank(message="Must be filled")
     * @ORM\Column(name="date_prevu_retour", type="date", nullable=false)
     */
    private $datePrevuRetour;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->dateSortie;
    }

    public function setDateSortie(\DateTimeInterface $dateSortie): self
    {
        $this->dateSortie = $dateSortie;

        return $this;
    }

    public function getIdVoiture(): ?int
    {
        return $this->idVoiture;
    }

    public function setIdVoiture(int $idVoiture): self
    {
        $this->idVoiture = $idVoiture;

        return $this;
    }

    public function getNumPlace(): ?int
    {
        return $this->numPlace;
    }

    public function setNumPlace(int $numPlace): self
    {
        $this->numPlace = $numPlace;

        return $this;
    }

    public function getDatePrevuRetour(): ?\DateTimeInterface
    {
        return $this->datePrevuRetour;
    }

    public function setDatePrevuRetour(\DateTimeInterface $datePrevuRetour): self
    {
        $this->datePrevuRetour = $datePrevuRetour;

        return $this;
    }






}
