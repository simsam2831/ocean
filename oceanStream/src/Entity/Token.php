<?php

namespace App\Entity;

use App\Repository\TokenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TokenRepository::class)
 */
class Token
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
    private $priceToken;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imageToken;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Event::class, inversedBy="tokens")
     */
    private $event;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="tokens")
     */
    private $users;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $family;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isSelected;



    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPriceToken(): ?int
    {
        return $this->priceToken;
    }

    public function setPriceToken(int $priceToken): self
    {
        $this->priceToken = $priceToken;

        return $this;
    }

    public function getImageToken(): ?string
    {
        return $this->imageToken;
    }

    public function setImageToken(string $imageToken): self
    {
        $this->imageToken = $imageToken;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

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
            $user->addToken($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeToken($this);
        }

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

    public function getIsSelected(): ?bool
    {
        return $this->isSelected;
    }

    public function setIsSelected(bool $isSelected): self
    {
        $this->isSelected = $isSelected;

        return $this;
    }

    public function __toString(): string
    {
        return (string) $this->getId();
    }
}
