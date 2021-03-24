<?php

namespace App\DataFixtures;

use App\Entity\Bot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BotFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $bots =  array();
        for($i = 0; $i < 3; $i++){
            $bot = new Bot();
            $bot->setNameBot('Bot n°' . $i)
                ->setDifficulty(1)
                ->addGame($this->getReference('game_' . $i));

            $manager->persist($bot);
            array_push($bots, $bot);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            GameFixtures::class
        );
    }
}
