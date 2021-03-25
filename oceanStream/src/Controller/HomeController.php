<?php

namespace App\Controller;

use App\Entity\Board;
use App\Service\BoardService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $manager): Response
    {
        $board = new BoardService();
        $board->create($manager);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
