<?php

namespace App\Entity;

use App\Application\Sonata\UserBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Sonata\MediaBundle\Model\MediaInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
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
    private $name;
    /**
     * @ORM\ManyToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Media", cascade={"persist"}, fetch="LAZY")
     */
    protected $media;

    /**
     * @ORM\OneToOne(targetEntity="App\Application\Sonata\MediaBundle\Entity\Gallery",cascade={"all"}, orphanRemoval=true)
     * @ORM\JoinColumn(name="gallery", referencedColumnName="id")
     */
    private $gallery;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $square;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $floors;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dimensions;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $equipment;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foundation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $overlap;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $roof;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $term;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $publish;

    /**
     * @ORM\Column(type="string", columnDefinition="enum('Проект', 'Объект')")
     */
    private $type;

    public function __construct()
    {
        $this->created_at = new \DateTime();
    }

    public function getCreatedAt(): ?string
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getGallery()
    {
        return $this->gallery;
    }

    public function setGallery($gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @param MediaInterface $media
     */
    public function setMedia(MediaInterface $media)
    {
        $this->media = $media;
    }

    /**
     * @return MediaInterface
     */
    public function getMedia()
    {
        return $this->media;
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

    public function getSquare(): ?string
    {
        return $this->square;
    }

    public function setSquare(string $square): self
    {
        $this->square = $square;

        return $this;
    }

    public function getFloors(): ?string
    {
        return $this->floors;
    }

    public function setFloors(string $floors): self
    {
        $this->floors = $floors;

        return $this;
    }

    public function getDimensions(): ?string
    {
        return $this->dimensions;
    }

    public function setDimensions(string $dimensions): self
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    public function getEquipment(): ?string
    {
        return $this->equipment;
    }

    public function setEquipment(string $equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getFoundation(): ?string
    {
        return $this->foundation;
    }

    public function setFoundation(string $foundation): self
    {
        $this->foundation = $foundation;

        return $this;
    }

    public function getOverlap(): ?string
    {
        return $this->overlap;
    }

    public function setOverlap(string $overlap): self
    {
        $this->overlap = $overlap;

        return $this;
    }

    public function getRoof(): ?string
    {
        return $this->roof;
    }

    public function setRoof(string $roof = ''): self
    {
        $this->roof = $roof;

        return $this;
    }

    public function getTerm(): ?string
    {
        return $this->term;
    }

    public function setTerm(string $term): self
    {
        $this->term = $term;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getPublish(): ?bool
    {
        return $this->publish;
    }

    public function setPublish(bool $publish): self
    {
        $this->publish = $publish;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }


}
