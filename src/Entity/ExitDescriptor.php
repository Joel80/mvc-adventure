<?php

namespace App\Entity;

use App\Repository\ExitDescriptorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExitDescriptorRepository::class)
 */
class ExitDescriptor
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
    private $leadsToRoom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $locatedInRoom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeadsToRoom(): ?string
    {
        return $this->leadsToRoom;
    }

    public function setLeadsToRoom(string $leadsToRoom): self
    {
        $this->leadsToRoom = $leadsToRoom;

        return $this;
    }

    public function getLocatedInRoom(): ?string
    {
        return $this->locatedInRoom;
    }

    public function setLocatedInRoom(string $locatedInRoom): self
    {
        $this->locatedInRoom = $locatedInRoom;

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
}
