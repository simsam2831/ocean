<?php

namespace App\Service;

use App\Entity\Board;
use Doctrine\ORM\EntityManagerInterface;

class BoardService
{
    public function create(EntityManagerInterface $manager): Board
    {
        $new_board = new Board();
        $manager->persist($new_board);
        $manager->flush();

        $template_board_id = 6;

        $old_board = $manager->getRepository(Board::class)->find($template_board_id);

        $eventService = new EventService();

        $new_special_events = $eventService->createSpecialEvent($manager, $old_board, $new_board);
        $new_not_special_events = $eventService->createNotSpecialEvent($manager, $old_board, $new_board);

        shuffle($new_not_special_events);

        $count = 0;
        for($i = 0; $i < 64; $i++){
            if($i == 0){
                ($new_special_events[0])->setLocation($i);
                $manager->persist($new_special_events[0]);
            }else if($i == 15){
                ($new_special_events[3])->setLocation($i);
                $manager->persist($new_special_events[3]);
            }else if($i == 32){
                ($new_special_events[2])->setLocation($i);
                $manager->persist($new_special_events[2]);
            }else if($i == 59){
                ($new_special_events[1])->setLocation($i);
                $manager->persist($new_special_events[1]);
            }else{
                ($new_not_special_events[$count])->setLocation($i);
                $manager->persist($new_not_special_events[$count++]);
            }
        }

        $manager->flush();
        return $new_board;
    }


}
