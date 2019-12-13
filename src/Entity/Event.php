<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $start_date;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $end_date;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Protagonist", inversedBy="events")
     */
    private $protagonists;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventRegistration", mappedBy="event")
     */
    private $eventRegistrations;

    public function __construct()
    {
        $this->protagonists = new ArrayCollection();
        $this->eventRegistrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(?\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(?\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    /**
     * @return Collection|Protagonist[]
     */
    public function getProtagonists(): Collection
    {
        return $this->protagonists;
    }

    public function addProtagonist(Protagonist $protagonist): self
    {
        if (!$this->protagonists->contains($protagonist)) {
            $this->protagonists[] = $protagonist;
        }

        return $this;
    }

    public function removeProtagonist(Protagonist $protagonist): self
    {
        if ($this->protagonists->contains($protagonist)) {
            $this->protagonists->removeElement($protagonist);
        }

        return $this;
    }

    /**
     * @return Collection|EventRegistration[]
     */
    public function getEventRegistrations(): Collection
    {
        return $this->eventRegistrations;
    }

    public function addEventRegistration(EventRegistration $eventRegistration): self
    {
        if (!$this->eventRegistrations->contains($eventRegistration)) {
            $this->eventRegistrations[] = $eventRegistration;
            $eventRegistration->setEvent($this);
        }

        return $this;
    }

    public function removeEventRegistration(EventRegistration $eventRegistration): self
    {
        if ($this->eventRegistrations->contains($eventRegistration)) {
            $this->eventRegistrations->removeElement($eventRegistration);
            // set the owning side to null (unless already changed)
            if ($eventRegistration->getEvent() === $this) {
                $eventRegistration->setEvent(null);
            }
        }

        return $this;
    }
}
