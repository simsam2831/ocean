<?php

namespace App\DataFixtures;

use App\Entity\Fish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FishFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $fishes = array();
        for($i = 0; $i < 15; $i++){
            $fish = new Fish();
            $fish->setName('Poisson n°' . $i)
                ->setFamily('Famille de poissons :  n°' . $i)
                ->setQuantity($i);

            $this->setReference('fish_' . $i, $fish);

            $manager->persist($fish);
            array_push($fishes, $fish);
        }

        $manager->flush();
    }
}
