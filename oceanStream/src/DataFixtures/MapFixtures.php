<?php

namespace App\DataFixtures;

use App\Entity\Map;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MapFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $map = new Map();
        $map->setPrice(200)
            ->setImage('./assets/img/fondDefault.png');

        $manager->persist($map);

        $manager->flush();
    }
}
