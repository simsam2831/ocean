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
            $fishEvent->setBoard($this->getReference('Board 1'))
                ->setNameEvent('Evenement Poisson n°' . $i)
                ->setDescriptionEvent('Des poissons et encore des poissons la vie n\'est-elle pas 
                    belle ?')
                ->setFishQuality($i);

            if($i < 15){
                $fishEvent->setFish($this->getReference('fish_' . $i));
            }
            elseif($i < 30){
                $fishEvent->setFish($this->getReference('fish_' . ($i - 15)));
            }else{
                $fishEvent->setFish($this->getReference('fish_' . ($i - 30)));
            }
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
