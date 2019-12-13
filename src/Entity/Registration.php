<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $registrationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Club", inversedBy="registrations")
     */
    private $club;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Protagonist", inversedBy="registrations")
     */
    private $protagonist;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registrationDate;
    }

    public function setRegistrationDate(\DateTimeInterface $registrationDate): self
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    public function getClub(): ?Club
    {
        return $this->club;
    }

    public function setClub(?Club $club): self
    {
        $this->club = $club;

        return $this;
    }

    public function getProtagonist(): ?Protagonist
    {
        return $this->protagonist;
    }

    public function setProtagonist(?Protagonist $protagonist): self
    {
        $this->protagonist = $protagonist;

        return $this;
    }
}
