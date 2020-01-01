<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProtagonistRepository")
 * @Vich\Uploadable
 */
class Protagonist
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
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $japaneseName;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="hero_pictures", fileNameProperty="picture")
     * @var File|null
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $background;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="protagonists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Tag", mappedBy="protagonists")
     */
    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Registration", mappedBy="protagonist")
     */
    private $registrations;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isAlive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventRegistration", mappedBy="protagonist", cascade={"persist"})
     */
    private $eventRegistrations;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->registrations = new ArrayCollection();
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

    public function getJapaneseName(): ?string
    {
        return $this->japaneseName;
    }

    public function setJapaneseName(?string $japaneseName): self
    {
        $this->japaneseName = $japaneseName;

        return $this;
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

    public function setPictureFile(File $picture = null)
    {
        $this->pictureFile = $picture;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($picture) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getBackground(): ?string
    {
        return $this->background;
    }

    public function setBackground(?string $background): self
    {
        $this->background = $background;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addProtagonist($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
            $tag->removeProtagonist($this);
        }

        return $this;
    }

    /**
     * @return Collection|Registration[]
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): self
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations[] = $registration;
            $registration->setProtagonist($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): self
    {
        if ($this->registrations->contains($registration)) {
            $this->registrations->removeElement($registration);
            // set the owning side to null (unless already changed)
            if ($registration->getProtagonist() === $this) {
                $registration->setProtagonist(null);
            }
        }

        return $this;
    }

    public function getIsAlive(): ?bool
    {
        return $this->isAlive;
    }

    public function setIsAlive(?bool $isAlive): self
    {
        $this->isAlive = $isAlive;

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
            $eventRegistration->setProtagonist($this);
        }

        return $this;
    }

    public function removeEventRegistration(EventRegistration $eventRegistration): self
    {
        if ($this->eventRegistrations->contains($eventRegistration)) {
            $this->eventRegistrations->removeElement($eventRegistration);
            // set the owning side to null (unless already changed)
            if ($eventRegistration->getProtagonist() === $this) {
                $eventRegistration->setProtagonist(null);
            }
        }

        return $this;
    }

}
