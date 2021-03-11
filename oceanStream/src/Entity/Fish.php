<?php

namespace App\Entity;

use App\Repository\FishRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FishRepository::class)
 */
class Fish
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $family;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\OneToMany(targetEntity=AnswerProposition::class, mappedBy="fish")
     */
    private $answerPropositions;

    /**
     * @ORM\OneToMany(targetEntity=FishEvent::class, mappedBy="fish")
     */
    private $fishEvent;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="fishes")
     */
    private $users;

    public function __construct()
    {
        $this->answerPropositions = new ArrayCollection();
        $this->fishEvent = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getFamily(): ?string
    {
        return $this->family;
    }

    public function setFamily(string $family): self
    {
        $this->family = $family;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection|AnswerProposition[]
     */
    public function getAnswerPropositions(): Collection
    {
        return $this->answerPropositions;
    }

    public function addAnswerProposition(AnswerProposition $answerProposition): self
    {
        if (!$this->answerPropositions->contains($answerProposition)) {
            $this->answerPropositions[] = $answerProposition;
            $answerProposition->setFish($this);
        }

        return $this;
    }

    public function removeAnswerProposition(AnswerProposition $answerProposition): self
    {
        if ($this->answerPropositions->removeElement($answerProposition)) {
            // set the owning side to null (unless already changed)
            if ($answerProposition->getFish() === $this) {
                $answerProposition->setFish(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FishEvent[]
     */
    public function getFishEvent(): Collection
    {
        return $this->fishEvent;
    }

    public function addFishEvent(FishEvent $fishEvent): self
    {
        if (!$this->fishEvent->contains($fishEvent)) {
            $this->fishEvent[] = $fishEvent;
            $fishEvent->setFish($this);
        }

        return $this;
    }

    public function removeFishEvent(FishEvent $fishEvent): self
    {
        if ($this->fishEvent->removeElement($fishEvent)) {
            // set the owning side to null (unless already changed)
            if ($fishEvent->getFish() === $this) {
                $fishEvent->setFish(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addFish($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeFish($this);
        }

        return $this;
    }
}
