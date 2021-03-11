<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=Fish::class, inversedBy="users")
     */
    private $fishes;

    /**
     * @ORM\ManyToMany(targetEntity=Map::class, inversedBy="users")
     */
    private $maps;

    /**
     * @ORM\ManyToMany(targetEntity=Token::class, inversedBy="users")
     */
    private $tokens;

    /**
     * @ORM\ManyToMany(targetEntity=Game::class, inversedBy="users")
     */
    private $games;

    public function __construct()
    {
        $this->fishes = new ArrayCollection();
        $this->maps = new ArrayCollection();
        $this->tokens = new ArrayCollection();
        $this->games = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;

    /**
     * @ORM\Column(type="string", length=64, unique=true)
     */
    private ?string $username;

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection|Fish[]
     */
    public function getFishes(): Collection
    {
        return $this->fishes;
    }

    public function addFish(Fish $fish): self
    {
        if (!$this->fishes->contains($fish)) {
            $this->fishes[] = $fish;
        }

        return $this;
    }

    public function removeFish(Fish $fish): self
    {
        $this->fishes->removeElement($fish);

        return $this;
    }

    /**
     * @return Collection|Map[]
     */
    public function getMaps(): Collection
    {
        return $this->maps;
    }

    public function addMap(Map $map): self
    {
        if (!$this->maps->contains($map)) {
            $this->maps[] = $map;
        }

        return $this;
    }

    public function removeMap(Map $map): self
    {
        $this->maps->removeElement($map);

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
        }

        return $this;
    }

    public function removeToken(Token $token): self
    {
        $this->tokens->removeElement($token);

        return $this;
    }

    /**
     * @return Collection|Game[]
     */
    public function getGames(): Collection
    {
        return $this->games;
    }

    public function addGame(Game $game): self
    {
        if (!$this->games->contains($game)) {
            $this->games[] = $game;
        }

        return $this;
    }

    public function removeGame(Game $game): self
    {
        $this->games->removeElement($game);

        return $this;
    }
}
