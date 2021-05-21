<?php

namespace App\Entity;

use App\Repository\EventDescriptorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EventDescriptorRepository::class)
 */
class EventDescriptor
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
    private $event;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $roomDescription;

    /**
     * @ORM\Column(type="boolean")
     */
    private $addExit;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $exitLeadsTo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $exitIsInRoom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $exitName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $eventRoom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $achievement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(string $event): self
    {
        $this->event = $event;

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

    public function getRoomDescription(): ?string
    {
        return $this->roomDescription;
    }

    public function setRoomDescription(string $roomDescription): self
    {
        $this->roomDescription = $roomDescription;

        return $this;
    }

    public function getAddExit(): ?bool
    {
        return $this->addExit;
    }

    public function setAddExit(bool $addExit): self
    {
        $this->addExit = $addExit;

        return $this;
    }

    public function getExitLeadsTo(): ?string
    {
        return $this->exitLeadsTo;
    }

    public function setExitLeadsTo(?string $exitLeadsTo): self
    {
        $this->exitLeadsTo = $exitLeadsTo;

        return $this;
    }

    public function getExitIsInRoom(): ?string
    {
        return $this->exitIsInRoom;
    }

    public function setExitIsInRoom(?string $exitIsInRoom): self
    {
        $this->exitIsInRoom = $exitIsInRoom;

        return $this;
    }

    public function getExitName(): ?string
    {
        return $this->exitName;
    }

    public function setExitName(?string $exitName): self
    {
        $this->exitName = $exitName;

        return $this;
    }

    public function getEventRoom(): ?string
    {
        return $this->eventRoom;
    }

    public function setEventRoom(string $eventRoom): self
    {
        $this->eventRoom = $eventRoom;

        return $this;
    }

    public function getAchievement(): ?string
    {
        return $this->achievement;
    }

    public function setAchievement(?string $achievement): self
    {
        $this->achievement = $achievement;

        return $this;
    }
}
