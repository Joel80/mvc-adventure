<?php

namespace App\Entity;

use App\Repository\AchievementLogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AchievementLogRepository::class)
 */
class AchievementLog
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $playerName;

    /**
     * @ORM\OneToMany(targetEntity=Achievement::class, mappedBy="achievementLog")
     */
    private $achievements;

    public function __construct()
    {
        $this->achievements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getPlayerName(): ?string
    {
        return $this->playerName;
    }

    public function setPlayerName(?string $playerName): self
    {
        $this->playerName = $playerName;

        return $this;
    }

    /**
     * @return Collection|Achievement[]
     */
    public function getAchievements(): Collection
    {
        return $this->achievements;
    }

    public function addAchievement(Achievement $achievement): self
    {
        if (!$this->achievements->contains($achievement)) {
            $this->achievements[] = $achievement;
            $achievement->setAchievementLog($this);
        }

        return $this;
    }

/*  public function removeAchievement(Achievement $achievement): self
    {
        if ($this->achievements->removeElement($achievement)) {
            // set the owning side to null (unless already changed)
            if ($achievement->getAchievementLog() === $this) {
                $achievement->setAchievementLog(null);
            }
        }

        return $this;
    } */
}
