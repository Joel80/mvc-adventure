<?php

namespace App\Entity;

use App\Repository\VisitRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VisitRepository::class)
 */
class Visit
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
    private $roomName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $timesVisited;

    /**
     * @ORM\ManyToOne(targetEntity=RoomVisitLog::class, inversedBy="visits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $roomVisitLog;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $roomIndex;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTimesVisited(): ?int
    {
        return $this->timesVisited;
    }

    public function setTimesVisited(?int $timesVisited): self
    {
        $this->timesVisited = $timesVisited;

        return $this;
    }

    /* public function getRoomVisitLog(): ?RoomVisitLog
    {
        return $this->roomVisitLog;
    } */

    public function setRoomVisitLog(?RoomVisitLog $roomVisitLog): self
    {
        $this->roomVisitLog = $roomVisitLog;

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
