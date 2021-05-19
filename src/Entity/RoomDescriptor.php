<?php

namespace App\Entity;

use App\Repository\RoomDescriptorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RoomDescriptorRepository::class)
 */
class RoomDescriptor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomIndex;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomImage;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomName;

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

    public function getRoomIndex(): ?string
    {
        return $this->roomIndex;
    }

    public function setRoomIndex(string $roomIndex): self
    {
        $this->roomIndex = $roomIndex;

        return $this;
    }

    public function getRoomImage(): ?string
    {
        return $this->roomImage;
    }

    public function setRoomImage(string $roomImage): self
    {
        $this->roomImage = $roomImage;

        return $this;
    }

    public function getRoomName(): ?string
    {
        return $this->roomName;
    }

    public function setRoomName(string $roomName): self
    {
        $this->roomName = $roomName;

        return $this;
    }
}
