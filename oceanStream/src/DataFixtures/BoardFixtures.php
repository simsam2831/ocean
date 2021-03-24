<?php

namespace App\DataFixtures;

use App\Entity\Board;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BoardFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i=0;$i<3;$i++)
        {
            $board=new Board();
            $this->setReference('board_'.$i, $board);

            $manager->persist($board);
        }

        $manager->flush();
    }
}
