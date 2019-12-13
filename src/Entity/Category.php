<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=70)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Protagonist", mappedBy="category", orphanRemoval=true)
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

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
            $protagonist->setCategory($this);
        }

        return $this;
    }

    public function removeProtagonist(Protagonist $protagonist): self
    {
        if ($this->protagonists->contains($protagonist)) {
            $this->protagonists->removeElement($protagonist);
            // set the owning side to null (unless already changed)
            if ($protagonist->getCategory() === $this) {
                $protagonist->setCategory(null);
            }
        }

        return $this;
    }
}
