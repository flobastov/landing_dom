<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PageRepository")
 */
class Page
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
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"}, unique=true, style="lowercase", separator="_", updatable=false)
     * @ORM\Column(length=128, unique=true)
     */
    private $slug;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updated_at;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\PageBlock", inversedBy="pages")
     */
    private $blocks;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publish;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->updated_at = new \DateTime();
        $this->blocks = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|PageBlock[]
     */
    public function getBlocks(): Collection
    {
        return $this->blocks;
    }

    public function addBlock(PageBlock $block): self
    {
        if (!$this->blocks->contains($block)) {
            $this->blocks[] = $block;
        }

        return $this;
    }

    public function removeBlock(PageBlock $block): self
    {
        if ($this->blocks->contains($block)) {
            $this->blocks->removeElement($block);
        }

        return $this;
    }

    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    public function setPublish(?bool $publish): self
    {
        $this->publish = $publish;

        return $this;
    }
}
