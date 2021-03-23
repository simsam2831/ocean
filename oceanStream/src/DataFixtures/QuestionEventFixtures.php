<?php

namespace App\DataFixtures;

use App\Entity\QuestionEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class QuestionEventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $questionEvents = array();
        for($i = 0; $i < 20; $i++){
            $questionEvent = new QuestionEvent();
            $questionEvent->setNameEvent('Evenèment qusetion n°' . $i)
                ->setDescriptionEvent('Des descriptions pour faire occuper de la place. 
                    Ceci est le n°' . $i)
                ->setBoard($this->getReference('Board 1'));

            array_push($questionEvents, $questionEvent);
            $manager->persist($questionEvent);
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
