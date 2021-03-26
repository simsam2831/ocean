<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Token;
use App\Repository\EventRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BoardController extends AbstractController
{
    /**
     * @Route("/{id}/{token}/board", name="board")
     * @param Game $game
     * @param Token $token
     * @param EventRepository $eventRepository
     * @return Response
     * @throws NonUniqueResultException
     */
    public function index(Game $game, Token $token, EventRepository $eventRepository): Response
    {
        $eventsToView = array();

        for($i = 0; $i < 64; $i++)
        {
            $event = $eventRepository->findByLocation($game->getBoard(), $i);
            array_push($eventsToView, $event);
        }

        return $this->render('board/index.html.twig', [
            'eventsToView' => $eventsToView,
            'token' => $token
        ]);
    }

    /**
     * @Route("/{id}/{token}/{rolldice}/board/dice", name="board_dice")
     * @param Game $game
     * @param Token $token
     * @param int $rolldice
     * @param EventRepository $eventRepository
     * @return Response
     * @throws NonUniqueResultException
     */
    public function dice(Game $game, Token $token, int $rolldice, EventRepository $eventRepository): Response
    {
        $eventsToView = array();

        for($i = 0; $i < 64; $i++)
        {
            $event = $eventRepository->findByLocation($game->getBoard(), $i);
            array_push($eventsToView, $event);
        }

        return $this->render('board/index.html.twig', [
            'eventsToView' => $eventsToView,
            'token' => $token,
            'rolldice' => $rolldice
        ]);
    }
}
