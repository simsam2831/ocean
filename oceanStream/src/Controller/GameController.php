<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Form\SelectModeType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/game")
 */
class GameController extends AbstractController
{
    /**
     * @Route("/select/mode", name="select_mode", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function selectMode(Request $request): Response
    {
        $game = new Game();
        $form = $this->createForm(SelectModeType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('select_nb_player', ['game' => $game]);
        }

        return $this->render('game/select_mode.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/select/nb_players", name="select_nb_players", methods={"GET","POST"})
     * @param Request $request
     * @param Game $game
     * @return Response
     */
    public function selectNbPlayers(Request $request, Game $game): Response
    {
        $form = $this->createForm(SelectNbPlayersType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('game_create', ['game' => $game]);
        }

        return $this->render('game/select_nb_players.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/", name="game_index", methods={"GET"})
     * @param GameRepository $gameRepository
     * @return Response
     */
    public function index(GameRepository $gameRepository): Response
    {
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
        ]);
    }

    /**
     * @Route("/create", name="game_create", methods={"GET"})
     * @param Game $game
     * @return Response
     */
    public function create(Game $game): Response
    {
        $game->setPending(false);
        $game->setGlobalTurn(1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($game);
        $entityManager->flush();

        return $this->redirectToRoute('game_play');
    }

    /**
     * @Route("/{id}/read", name="game_read", methods={"GET"})
     * @param Game $game
     * @return Response
     */
    public function read(Game $game): Response
    {
        return $this->render('game/read.html.twig', [
            'game' => $game,
        ]);
    }

    /**
     * @Route("/{id}/update", name="game_update", methods={"GET","POST"})
     * @param Request $request
     * @param Game $game
     * @return Response
     */
    public function update(Request $request, Game $game): Response
    {
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('game_index');
        }

        return $this->render('game/update.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="game_delete", methods={"DELETE"})
     * @param Request $request
     * @param Game $game
     * @return Response
     */
    public function delete(Request $request, Game $game): Response
    {
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($game);
            $entityManager->flush();
        }

        return $this->redirectToRoute('game_index');
    }

    /**
     * @Route("/gameBase", name="gameBase")
     * @param GameRepository $gameRepository
     *
     */
    public function viewbase(GameRepository $gameRepository): Response
    {
        return $this->render('game/gameBase.html.twig', [
        ]);
    }
}
