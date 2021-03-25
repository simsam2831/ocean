<?php

namespace App\Entity;

use App\Repository\SpecialEventRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SpecialEventRepository::class)
 */
class SpecialEvent extends Event
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isBlocked;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isGoal;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $event_destination;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsBlocked(): ?bool
    {
        return $this->isBlocked;
    }

    public function setIsBlocked(bool $isBlocked): self
    {
        $this->isBlocked = $isBlocked;

        return $this;
    }

    public function getIsGoal(): ?bool
    {
        return $this->isGoal;
    }

    public function setIsGoal(bool $isGoal): self
    {
        $this->isGoal = $isGoal;

        return $this;
    }

    public function getEventDestination(): ?int
    {
        return $this->event_destination;
    }

    public function setEventDestination(?int $event_destination): self
    {
        $this->event_destination = $event_destination;

        return $this;
    }
}
