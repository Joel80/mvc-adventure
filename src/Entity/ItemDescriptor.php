<?php

namespace App\Entity;

use App\Repository\ItemDescriptorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemDescriptorRepository::class)
 */
class ItemDescriptor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itemId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $placementDescription;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomIndex;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getItemId(): ?string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;

        return $this;
    }

    public function getPlacementDescription(): ?string
    {
        return $this->placementDescription;
    }

    public function setPlacementDescription(string $placementDescription): self
    {
        $this->placementDescription = $placementDescription;

        return $this;
    }

    public function getRoomIndex(): ?string
    {
        return $this->roomIndex;
    }

    public function setRoomIndex(string $roomIndex): self
    {
        $this->roomIndex = $roomIndex;

        return $this;
    }
}
