<?php

namespace App\Entity;

use App\Repository\AchievementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AchievementRepository::class)
 */
class Achievement
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
     * @ORM\ManyToOne(targetEntity=AchievementLog::class, inversedBy="achievements")
     */
    private $achievementLog;

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

  /*   public function getAchievementLog(): ?AchievementLog
    {
        return $this->achievementLog;
    } */

    public function setAchievementLog(?AchievementLog $achievementLog): self
    {
        $this->achievementLog = $achievementLog;

        return $this;
    }
}
