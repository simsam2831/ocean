<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    /**
     * @Route("/{id}/board", name="board")
     * @param Game $game
     * @param EventRepository $eventRepository
     * @return Response
     */
    public function index(Game $game, EventRepository $eventRepository): Response
    {
        $eventsToView = array();

        for($i = 0; $i < 64; $i++)
        {
            $event = $eventRepository->findByLocation($game->getBoard(), $i);
            array_push($eventsToView, $event);
        }

        return $this->render('board/index.html.twig', [
            'eventsToView' => $eventsToView
        ]);
    }
}
