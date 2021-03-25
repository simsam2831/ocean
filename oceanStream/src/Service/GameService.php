<?php

namespace App\Service;

use App\Entity\Board;
use App\Entity\Bot;
use App\Entity\Game;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class GameService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;
    /**
     * @var UserInterface
     */
    private UserInterface $user;

    public function __construct(EntityManagerInterface $manager, UserInterface $user)
    {
        $this->manager = $manager;
        $this->user = $user;
    }

    public function create(Board $board): Game
    {
        $game = new Game();
        $user = $this->manager->getRepository(User::class)->find($this->user->getId());
        $game->setBoard($board)
            ->setNbPlayers(4)
            ->setMode('local')
            ->setIsPending(true)
            ->setGlobalTurn(0)
            ->addUser($user);

        $bots = $this->manager->getRepository(Bot::class)->findBy([
            'difficulty' => 1
        ]);
        foreach($bots as $bot)
        {
            $game->addBot($bot);
        }

        $this->manager->persist($game);
        $this->manager->flush();

        return $game;
    }
}
