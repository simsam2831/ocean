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
                ->setImageAnswer('./assets/img/logo.png');

            if($i < 19){
                $answerProposition->setIsCorrect(true)
                    ->addQuestionEvent($this->getReference('questionEvent_' . $i))
                    ->addQuestionEvent($this->getReference('questionEvent_' . ($i + 1)));
            }else{
                $answerProposition->setIsCorrect(false)
                    ->addQuestionEvent($this->getReference('questionEvent_' . rand(0, 19)));
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
