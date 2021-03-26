<?php

namespace App\Controller;

use App\Entity\Token;
use App\Service\RollDiceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DiceController extends AbstractController
{
    /**
     * @Route("/{id}/dice", name="dice")
     * @param Token $token
     * @return Response
     */
    public function index(Token $token): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $game = $token->getEvent()->getBoard()->getGame();
        $service = new RollDiceService();

        return $this->redirectToRoute('board_dice', [
            'id' => $game->getId(),
            'token' => $token,
            'rolldice' => $service->roll($entityManager, $token, $game)
        ]);
    }
}
