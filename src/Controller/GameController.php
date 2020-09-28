<?php

namespace App\Controller;

use App\Entity\Game;
use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game")
     * @param GameRepository $gameRepository
     * @param SerializerInterface $serializer
     * @return string
     */
    public function retrieveGameList(GameRepository $gameRepository, SerializerInterface $serializer)
    {
        $games = $gameRepository->findAll();
        $serializedGame = $serializer->serialize($games,"json");

        return new Response($serializedGame);
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
