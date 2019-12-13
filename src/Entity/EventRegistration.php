<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRegistrationRepository")
 */
class EventRegistration
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Protagonist", inversedBy="eventRegistrations")
     */
    private $protagonist;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="eventRegistrations")
     */
    private $event;

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

    public function getProtagonist(): ?Protagonist
    {
        return $this->protagonist;
    }

    public function setProtagonist(?Protagonist $protagonist): self
    {
        $this->protagonist = $protagonist;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

        return $this;
    }
}
