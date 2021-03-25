<?php

namespace App\Service;

use App\Entity\AnswerProposition;
use App\Entity\Board;
use App\Entity\Event;
use App\Entity\FishEvent;
use App\Entity\QuestionEvent;
use App\Entity\SpecialEvent;
use Doctrine\ORM\EntityManagerInterface;

class EventService
{
    public function createSpecialEvent(EntityManagerInterface $manager, Board $old_board, Board $new_board): array
    {
        $special_events = $manager->getRepository(SpecialEvent::class)->findBy([
            'board' => $old_board
        ]);

        $new_special_events = array();

        $case_depart = new SpecialEvent();
        $case_depart->setNameEvent($special_events[0]->getNameEvent())
            ->setDescriptionEvent($special_events[0]->getDescriptionEvent())
            ->setBoard($new_board)
            ->setIsGoal($special_events[0]->getIsGoal())
            ->setIsBlooked($special_events[0]->getIsBlooked());
        array_push($new_special_events, $case_depart);

        $short_cut = new SpecialEvent();
        $short_cut->setNameEvent($special_events[3]->getNameEvent())
            ->setDescriptionEvent($special_events[3]->getDescriptionEvent())
            ->setBoard($new_board)
            ->setIsGoal($special_events[3]->getIsGoal())
            ->setIsBlooked($special_events[3]->getIsBlooked());
        array_push($new_special_events, $short_cut);

        $gbc = new SpecialEvent();
        $gbc->setNameEvent($special_events[2]->getNameEvent())
            ->setDescriptionEvent($special_events[2]->getDescriptionEvent())
            ->setBoard($new_board)
            ->setIsGoal($special_events[2]->getIsGoal())
            ->setIsBlooked($special_events[2]->getIsBlooked());
        array_push($new_special_events, $gbc);

        $bermudas = new SpecialEvent();
        $bermudas->setNameEvent($special_events[1]->getNameEvent())
            ->setDescriptionEvent($special_events[1]->getDescriptionEvent())
            ->setBoard($new_board)
            ->setIsGoal($special_events[1]->getIsGoal())
            ->setIsBlooked($special_events[1]->getIsBlooked());
        array_push($new_special_events, $bermudas);

        return $new_special_events;
    }

    public function createNotSpecialEvent(EntityManagerInterface $manager, Board $old_board, Board $new_board): array
    {
        $events = $manager->getRepository(Event::class)->findBy([
            'board' => $old_board
        ]);

        $answerPropositions = $manager->getRepository(AnswerProposition::class)->findAll();

        $questions_fish = array();
        foreach ($events as $event)
        {
            if(!is_a($event, 'App\Entity\SpecialEvent'))
            {
                if(is_a($event, 'App\Entity\QuestionEvent'))
                {
                    $question_event = new QuestionEvent();
                    $question_event->setBoard($new_board)
                        ->setCategory($event->getCategory())
                        ->setDescriptionEvent($event->getDescriptionEvent())
                        ->setNameEvent($event->getNameEvent());

                    $event_answers = $event->getAnswerPropositions();

                    foreach($event_answers as $answer)
                    {
                        $question_event->addAnswerProposition($answer);
                    }

                    array_push($questions_fish, $question_event);
                }
                elseif (is_a($event,'App\Entity\FishEvent')){
                    $fish_event = new FishEvent();
                    $fish_event->setBoard($new_board)
                        ->setFish($event->getFish())
                        ->setFishQuantity($event->getFishQuantity())
                        ->setDescriptionEvent($event->getDescriptionEvent())
                        ->setNameEvent($event->getNameEvent());

                    array_push($questions_fish, $fish_event);
                }
            }
        }

        return $questions_fish;
    }
}