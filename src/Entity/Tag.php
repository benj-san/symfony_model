<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Protagonist", inversedBy="tags")
     */
    private $protagonists;

    public function __construct()
    {
        $this->protagonists = new ArrayCollection();
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
}
