<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @param GameRepository $gameRepository
     * @return JsonResponse
     */
    public function retrieveGameList(GameRepository $gameRepository)
    {
        return $this->json($gameRepository->findAll());
    }

    /**
     * @Route("/game/{id}", name="singleGame")
     * @param int $id
     * @param GameRepository $gameRepository
     * @return JsonResponse
     */
    public function retrieveSingleGame(int $id,GameRepository $gameRepository){
        return $this->json($gameRepository->find($id));
    }
}
