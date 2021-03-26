<?php

namespace App\DataFixtures;

use App\Entity\SpecialEvent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SpecialEventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0;$i<3;$i++)
        {
            $start = new SpecialEvent();
            $start->setBoard($this->getReference('board_'.$i))
                ->setLocation(-1)
                ->setEventDestination(0)
                ->setDescriptionEvent('Je suis la case départ&arrivé !')
                ->setNameEvent('Case départ')
                ->setIsBlocked(false)
                ->setIsGoal(false);

            $manager->persist($start);

            $bermudes = new SpecialEvent();
            $bermudes->setBoard($this->getReference('board_'.$i))
                ->setLocation(-1)
                ->setEventDestination(1)
                ->setDescriptionEvent('On raconte que la Cité perdue d\'Atlantide est quelque part ici. 
                        Mais beaucoup y perde la vie en s\'aventurant dans ces eaux. Peut-être vous êtes le suivant ?')
                ->setNameEvent('Triangle des Bermudes')
                ->setIsBlocked(true)
                ->setIsGoal(false);

            $manager->persist($bermudes);

            $gbc = new SpecialEvent();
            $gbc->setBoard($this->getReference('board_'.$i))
                ->setLocation(-1)
                ->setEventDestination(32)
                ->setDescriptionEvent('L\'immanquable ! Comment passer à côté de cette 
                        merveille de la nature ?')
                ->setNameEvent('La Grande Barrière de Corail')
                ->setIsBlocked(true)
                ->setIsGoal(false);

            $manager->persist($gbc);

            $roadToAdventure = new SpecialEvent();
            $roadToAdventure->setBoard($this->getReference('board_'.$i))
                ->setLocation(-1)
                ->setEventDestination(45)
                ->setDescriptionEvent('Pssst... Hey ! Vous là-bas ! Oui c\'est de toi dont je parle. 
                        Un raccourci ?')
                ->setNameEvent('Tout droit vers l\'aventure !')
                ->setIsBlocked(false)
                ->setIsGoal(false);

            $manager->persist($roadToAdventure);
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
