<?php

namespace App\Entity;

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
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tutorial", mappedBy="category", cascade={"persist", "remove"})
     */
    private $tutorial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getTutorial(): ?Tutorial
    {
        return $this->tutorial;
    }

    public function setTutorial(Tutorial $tutorial): self
    {
        $this->tutorial = $tutorial;

        // set the owning side of the relation if necessary
        if ($this !== $tutorial->getCategory()) {
            $tutorial->setCategory($this);
        }

        return $this;
    }
        public function __toString(){
        // to show the name of the Category in the select
        return $this->Name;
        // to show the id of the Category in the select
        // return $this->id;
    }
}
