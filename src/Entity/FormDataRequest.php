<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FormDataRequestRepository")
 */
class FormDataRequest
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="json_array")
     */
    private $raw;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRaw()
    {
        return $this->raw;
    }

    public function setRaw($raw): self
    {
        $this->raw = $raw;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt->format('d.m.Y H:i');
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->createdAt = $created_at;

        return $this;
    }
}
