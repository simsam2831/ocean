<?php

namespace App\Entity;

use App\Repository\FishEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FishEventRepository::class)
 */
class FishEvent extends Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $fishQuality;

    /**
     * @ORM\ManyToOne(targetEntity=Fish::class, inversedBy="fishEvent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFishQuality(): ?int
    {
        return $this->fishQuality;
    }

    public function setFishQuality(int $fishQuality): self
    {
        $this->fishQuality = $fishQuality;

        return $this;
    }

    public function getFish(): ?Fish
    {
        return $this->fish;
    }

    public function setFish(?Fish $fish): self
    {
        $this->fish = $fish;

        return $this;
    }
}
