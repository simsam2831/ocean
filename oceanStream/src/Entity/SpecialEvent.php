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
    private $isBlooked;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isGoal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsBlooked(): ?bool
    {
        return $this->isBlooked;
    }

    public function setIsBlooked(bool $isBlooked): self
    {
        $this->isBlooked = $isBlooked;

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
}
