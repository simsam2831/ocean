<?php

namespace App\Service;

use App\Entity\Board;
use App\Entity\Event;
use App\Entity\FishEvent;
use App\Entity\QuestionEvent;
use App\Entity\SpecialEvent;
use Doctrine\ORM\EntityManagerInterface;

class BoardService
{
    public function create(EntityManagerInterface $manager): array
    {
        $new_board = new Board();

        $old_board = $manager->getRepository(Board::class)->find(1);

        $special_events = $manager->getRepository(SpecialEvent::class)->findBy([
            'board' => $old_board
        ]);

        $events = $manager->getRepository(Event::class)->findBy([
            'board' => $old_board
        ]);

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

                    array_push($questions_fish, $question_event);
                    $manager->persist($question_event);
                }
                elseif (is_a($event,'App\Entity\FishEvent')){
                    $fish_event = new FishEvent();
                    $fish_event->setBoard($new_board)
                        ->setFish($event->getFish())
                        ->setFishQuantity($event->getFishQuantity())
                        ->setDescriptionEvent($event->getDescriptionEvent())
                        ->setNameEvent($event->getNameEvent());

                    array_push($questions_fish, $fish_event);
                    $manager->persist($fish_event);
                }

            }
        }
        shuffle($questions_fish);

        $random_board = array();
        $count = 0;
        for($i = 0; $i < 64; $i++){
            if($i == 0){
                $new_special_event = new SpecialEvent();
                $new_special_event->setNameEvent($special_events[0]->getNameEvent())
                    ->setDescriptionEvent($special_events[0]->getDescriptionEvent())
                    ->setBoard($new_board)
                    ->setIsGoal($special_events[0]->getIsGoal())
                    ->setIsBlooked($special_events[0]->getIsBlooked());
                array_push($random_board, $new_special_event);
                $manager->persist($new_special_event);
            }else if($i == 15){
                $new_special_event = new SpecialEvent();
                $new_special_event->setNameEvent($special_events[3]->getNameEvent())
                    ->setDescriptionEvent($special_events[3]->getDescriptionEvent())
                    ->setBoard($new_board)
                    ->setIsGoal($special_events[3]->getIsGoal())
                    ->setIsBlooked($special_events[3]->getIsBlooked());
                array_push($random_board, $new_special_event);
                $manager->persist($new_special_event);
            }else if($i == 32){
                $new_special_event = new SpecialEvent();
                $new_special_event->setNameEvent($special_events[2]->getNameEvent())
                    ->setDescriptionEvent($special_events[2]->getDescriptionEvent())
                    ->setBoard($new_board)
                    ->setIsGoal($special_events[2]->getIsGoal())
                    ->setIsBlooked($special_events[2]->getIsBlooked());
                array_push($random_board, $new_special_event);
                $manager->persist($new_special_event);
            }else if($i == 59){
                $new_special_event = new SpecialEvent();
                $new_special_event->setNameEvent($special_events[1]->getNameEvent())
                    ->setDescriptionEvent($special_events[1]->getDescriptionEvent())
                    ->setBoard($new_board)
                    ->setIsGoal($special_events[1]->getIsGoal())
                    ->setIsBlooked($special_events[1]->getIsBlooked());
                array_push($random_board, $new_special_event);
                $manager->persist($new_special_event);
            }else{
                array_push($random_board, $questions_fish[$count++]);
            }
        }
        $manager->flush();
        dd($random_board);
        return $random_board;
    }
}
