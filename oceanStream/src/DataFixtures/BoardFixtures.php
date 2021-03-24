<?php

namespace App\DataFixtures;

use App\Entity\Board;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BoardFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $board = new Board();

        $this->setReference('Board 1', $board);

        $manager->persist($board);

        $manager->flush();
    }
}
