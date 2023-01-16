<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TutorialRepository")
 */
class Tutorial
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
    private $Title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $PublishAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublish;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $VideoLink;

    /**
     * @Gedmo\Slug(fields={"Title"})
     * @ORM\Column(length=255, unique=true, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="tutorial", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="integer")
     */
    private $order_menu = 1 ;

    public function __toString()
    {
        return $this->Title;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->Title;
    }

    public function setTitle(string $Title): self
    {
        $this->Title = $Title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->Content;
    }

    public function setContent(?string $Content): self
    {
        $this->Content = $Content;

        return $this;
    }

    public function getPublishAt(): ?\DateTimeInterface
    {
        return $this->PublishAt;
    }

    public function setPublishAt(\DateTimeInterface $PublishAt): self
    {
        $this->PublishAt = $PublishAt;

        return $this;
    }

    public function getIsPublish(): ?bool
    {
        return $this->isPublish;
    }

    public function setIsPublish(bool $isPublish): self
    {
        $this->isPublish = $isPublish;

        return $this;
    }

    public function getVideoLink(): ?string
    {
        return $this->VideoLink;
    }

    public function setVideoLink(string $VideoLink): self
    {
        $this->VideoLink = $VideoLink;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug(?string $Content): self
    {
        $this->slug = $this->getTitle();

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getOrderMenu(): ?int
    {
        return $this->order_menu;
    }

    public function setOrderMenu(int $order_menu): self
    {
        $this->order_menu = $order_menu;

        return $this;
    }

    public function getCategoryName(): ?string
    {
        return $this->getCategory()->getName();
    }

}
