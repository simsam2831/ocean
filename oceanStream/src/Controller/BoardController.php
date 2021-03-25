<?php

namespace App\Controller;

use App\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    /**
     * @Route("/{id}/board", name="board")
     * @param Game $game
     * @return Response
     */
    public function index(Game $game): Response
    {
        return $this->render('board/index.html.twig', [
            'events' => $game->getBoard()->getEvents(),
        ]);
    }
}
