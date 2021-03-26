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
        $category = ['Histoire', 'Géographie', 'Nature', 'Enigme', 'Pollution'];

        for ($j=0;$j<3;$j++){
            for($i = 0; $i < 20; $i++){
                $questionEvent = new QuestionEvent();
                $questionEvent->setNameEvent('Evenement question n°' . $i)
                    ->setDescriptionEvent('Des descriptions pour faire occuper de la place. 
                        Ceci est le n°' . $i)
                    ->setLocation($i)
                    ->setCategory($category[array_rand($category, 1)])
                    ->setBoard($this->getReference('board_'.$j));

                $this->setReference('questionEvent_' . $i, $questionEvent);

                $manager->persist($questionEvent);
            }
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
