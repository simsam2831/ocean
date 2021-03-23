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
    private $fishQuantity;

    /**
     * @ORM\ManyToOne(targetEntity=Fish::class, inversedBy="fishEvent")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fish;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFishQuantity(): ?int
    {
        return $this->fishQuantity;
    }

    public function setFishQuantity(int $fishQuantity): self
    {
        $this->fishQuantity = fishQuantity;

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
