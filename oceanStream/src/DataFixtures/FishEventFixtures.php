<?php

namespace App\DataFixtures;

use App\Entity\FishEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FishEventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $fishEvents = array();
        for($i = 0; $i < 40; $i++){
            $fishEvent = new FishEvent();
            $fishEvent->setNameEvent('Evenement Poisson n°' . $i)
                ->setDescriptionEvent('Des poissons et encore des poissons la vie n\'est-elle pas 
                    belle ?')
                ->setFishQuantity(rand(0,5))
                ->setFish($this->getReference('fish_' . rand(0, 14)))
                ->setBoard($this->getReference('board_1'));

            $manager->persist($fishEvent);
            array_push($fishEvents, $fishEvent);
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
