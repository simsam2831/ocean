<?php

namespace App\Service;

use App\Entity\Event;
use App\Entity\Game;
use App\Entity\Token;
use Doctrine\ORM\EntityManagerInterface;

class RollDiceService
{
    public function roll(EntityManagerInterface $manager, Token $token, Game $game)
    {
        $rolled = rand(1,6);
        $current_location = $token->getEvent()->getLocation();
        if(($current_location + $rolled) > 63)
        {
            $new_location = $current_location + $rolled - 63;
        }

        $new_location = $manager->getRepository(Event::class)->findBy([
            'board' => $game->getBoard(),
            'location' =>  + $rolled
        ]);

        $token->setEvent();

        return $rolled;
    }
}