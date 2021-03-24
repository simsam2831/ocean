<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $games = array();
        for($i = 0; $i < 3; $i++){
            $game = new Game();
            $game->setBoard($this->getReference('board_1'))
                ->setGlobalTurn(0)
                ->setIsPending(false)
                ->setMode('classic')
                ->setNbPlayers(4);

            $this->setReference('game_' . $i, $game);

            $manager->persist($game);
            array_push($games, $game);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            BoardFixtures::class
        );
    }
}
