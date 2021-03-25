<?php

namespace App\Service;

use App\Entity\Board;
use App\Entity\Bot;
use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class GameService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function create(UserInterface $user, Game $game, Board $board): Game
    {
        $game->setBoard($board)
            ->setNbPlayers(4)
            ->setMode('local')
            ->setIsPending(true)
            ->setGlobalTurn(0)
            ->addUser($user->getId());

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
