<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GameRepository::class)
 */
class Game
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="games")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Token::class, mappedBy="game")
     */
    private $tokens;

    /**
     * @ORM\ManyToMany(targetEntity=Bot::class, inversedBy="games")
     */
    private $bots;

    /**
     * @ORM\ManyToOne(targetEntity=Board::class, inversedBy="games")
     * @ORM\JoinColumn(nullable=false)
     */
    private $board;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $mode;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPlayers;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPending;

    /**
     * @ORM\Column(type="integer")
     */
    private $globalTurn;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->tokens = new ArrayCollection();
        $this->bots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $user->addGame($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeGame($this);
        }

        return $this;
    }

    /**
     * @return Collection|Token[]
     */
    public function getTokens(): Collection
    {
        return $this->tokens;
    }

    public function addToken(Token $token): self
    {
        if (!$this->tokens->contains($token)) {
            $this->tokens[] = $token;
            $token->setGame($this);
        }

        return $this;
    }

    public function removeToken(Token $token): self
    {
        if ($this->tokens->removeElement($token)) {
            // set the owning side to null (unless already changed)
            if ($token->getGame() === $this) {
                $token->setGame(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Bot[]
     */
    public function getBots(): Collection
    {
        return $this->bots;
    }

    public function addBot(Bot $bot): self
    {
        if (!$this->bots->contains($bot)) {
            $this->bots[] = $bot;
        }

        return $this;
    }

    public function removeBot(Bot $bot): self
    {
        $this->bots->removeElement($bot);

        return $this;
    }

    public function getBoard(): ?Board
    {
        return $this->board;
    }

    public function setBoard(?Board $board): self
    {
        $this->board = $board;

        return $this;
    }

    public function getMode(): ?string
    {
        return $this->mode;
    }

    public function setMode(string $mode): self
    {
        $this->mode = $mode;

        return $this;
    }

    public function getNbPlayers(): ?int
    {
        return $this->nbPlayers;
    }

    public function setNbPlayers(int $nbPlayers): self
    {
        $this->nbPlayers = $nbPlayers;

        return $this;
    }

    public function getIsPending(): ?bool
    {
        return $this->isPending;
    }

    public function setIsPending(bool $isPending): self
    {
        $this->isPending = $isPending;

        return $this;
    }

    public function getGlobalTurn(): ?int
    {
        return $this->globalTurn;
    }

    public function setGlobalTurn(int $globalTurn): self
    {
        $this->globalTurn = $globalTurn;

        return $this;
    }
}
