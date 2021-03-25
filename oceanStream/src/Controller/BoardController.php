<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/game")
 */
class BoardController extends AbstractController
{
    /**
     * @Route("/board", name="board")
     * @param EntityManagerInterface $manager
     * @param SessionInterface $session
     * @param UserInterface $user
     * @return Response
     */
    public function index(EntityManagerInterface $manager, SessionInterface $session,UserInterface $user): Response
    {
        $board = new BoadService($manager,$session,$user);
        return $this->render('board/index.html.twig', [
            'board' => createBoardService(),
        ]);
    }
}
