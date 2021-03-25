<?php

namespace App\Service;

use App\Entity\Game;
use Doctrine\ORM\EntityManagerInterface;

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

    public function create(Game $game)
    {

    }
}
