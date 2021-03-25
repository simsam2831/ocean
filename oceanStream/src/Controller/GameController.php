<?php

namespace App\Controller;

use App\Entity\Bot;
use App\Entity\Game;
use App\Form\GameType;
use App\Form\SelectModeType;
use App\Form\SelectNbPlayersType;
use App\Repository\GameRepository;
use App\Service\BoardService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
            return $this->redirectToRoute('select_nb_players', [
                'mode' => $game->getMode()
            ]);
        }

        return $this->render('game/select_mode.html.twig', [
            'game' => $game,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{mode}/select/nb_players", name="select_nb_players", methods={"GET","POST"})
     * @param Request $request
     * @param string $mode
     * @return Response
     */
    public function selectNbPlayers(Request $request, string $mode): Response
    {
        $game = new Game();
        $form = $this->createForm(SelectNbPlayersType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('game_create', [
                'mode' => $mode,
                //'nb_players' => $game->getNbPlayers()
            ]);
        }

        return $this->render('game/select_nb_player.html.twig', [
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
     * @Route("/{mode}/create", name="game_create", methods={"GET"})
     * @param BoardService $boardService
     * @param string $mode
     * @return Response
     */
    public function create(BoardService $boardService, string $mode): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $board = $boardService->create($entityManager);
        $nb_players = 4;
        $game = new Game();
        $game->setMode($mode);
        $game->setNbPlayers($nb_players);
        $game->setIsPending(false);
        $game->setGlobalTurn(1);
        $game->addUser($this->getUser());
        $game->setBoard($board);
        $entityManager->persist($game);
        $entityManager->flush();

        for($i = 0; $i < $nb_players-1; $i++)
        {
            $bot = new Bot();
            $bot->setNameBot("Anonyme ".$i);
            $bot->setDifficulty("controlled");
            $bot->setIsBotControlled(true);
            $bot->addGame($game);
            $entityManager->persist($bot);
            $entityManager->flush();
        }

        return $this->redirectToRoute('board', [
            'id' => $game->getId()
        ]);
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
