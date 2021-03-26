<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\Game;
use App\Entity\Token;
use Doctrine\ORM\EntityManagerInterface;

class RollDiceService
{
    public function roll(EntityManagerInterface $manager, Token $token, Game $game): int
    {
        $rolled = rand(2,12);
        $current_location = $token->getEvent()->getLocation();
        if(($current_location + $rolled) > 63) {
            $new_location = $current_location + $rolled - 64;
        }
        else{
            $new_location = $current_location + $rolled;
        }

        $new_event = $manager->getRepository(Event::class)->findBy([
            'board' => $game->getBoard(),
            'location' => $new_location
        ]);

        $token->setEvent($new_event[0]);
        $manager->persist($token);
        $manager->flush();

        return $rolled;
    }
}
