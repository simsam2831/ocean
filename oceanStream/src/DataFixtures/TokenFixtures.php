<?php

namespace App\DataFixtures;

use App\Entity\Token;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TokenFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $colors = ['blue', 'green', 'yellow', 'red'];
        $tokens = array();
        for ($i = 0; $i < 12; $i++){
            $token = new Token();
            $token->setPriceToken($i+10)
                ->setImageToken('./assets/img/token_dauphin_temp.jpg');

            if($i < 3){
                $token->setColor($colors[0]);
            }elseif ($i < 6){
                $token->setColor($colors[1]);
            }elseif ($i < 9){
                $token->setColor($colors[2]);
            }else{
                $token->setColor($colors[3]);
            }

            array_push($tokens, $token);
            $manager->persist($token);
        }

        $manager->flush();
    }
}
