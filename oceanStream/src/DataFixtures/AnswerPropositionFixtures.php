<?php

namespace App\DataFixtures;

use App\Entity\AnswerProposition;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AnswerPropositionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        for($i = 0; $i < 60; $i++){
            $answerProposition = new AnswerProposition();
            $answerProposition->setFish($this->getReference('fish_' . rand(0, 14)))
                ->setDescriptionAnswer('Je suis la description n°' . $i)
                ->setFishQuantity(rand(2,5))
                ->setQuestionEvent($this->getReference('questionEvent_' . rand(0, 19)))
                ->setImageAnswer('./assets/img/logo.png');

            if($i < 20){
                $answerProposition->setIsCorrect(true);
            }else{
                $answerProposition->setIsCorrect(false);
            }

            $manager->persist($answerProposition);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return ([
           FishFixtures::class,
           QuestionEventFixtures::class,
        ]);
    }
}
