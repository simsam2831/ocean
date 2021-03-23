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
        $start = new SpecialEvent();
        $start->setBoard($this->getReference('Board 1'))
            ->setDescriptionEvent('Je suis la case départ&arrivé !')
            ->setNameEvent('Case départ')
            ->setIsBlooked(false)
            ->setIsGoal(false);

        $manager->persist($start);

        $bermudes = new SpecialEvent();
        $bermudes->setBoard($this->getReference('Board 1'))
            ->setDescriptionEvent('On raconte que la Cité perdue d\'Atlantide est quelque part ici. 
                Mais beaucoup y perde la vie en s\'aventurant dans ces eaux. Peut-être vous êtes le suivant ?')
            ->setNameEvent('Triangle des Bermudes')
            ->setIsBlooked(true)
            ->setIsGoal(false);

        $manager->persist($bermudes);

        $gbc = new SpecialEvent();
        $gbc->setBoard($this->getReference('Board 1'))
            ->setDescriptionEvent('L\'immanquable ! Comment passer à côté de cette 
                merveille de la nature ?')
            ->setNameEvent('La Grande Barrière de Corail')
            ->setIsBlooked(true)
            ->setIsGoal(false);

        $manager->persist($gbc);

        $roadToAdventure = new SpecialEvent();
        $roadToAdventure->setBoard($this->getReference('Board 1'))
            ->setDescriptionEvent('Pssst... Hey ! Vous là-bas ! Oui c\'est de toi dont je parle. 
                Un raccourci ?')
            ->setNameEvent('Tout droit vers l\'aventure !')
            ->setIsBlooked(false)
            ->setIsGoal(false);

        $manager->persist($roadToAdventure);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return array(
            BoardFixtures::class
        );
    }
}
