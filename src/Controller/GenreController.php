<?php

namespace App\Controller;

use App\Repository\GameRepository;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * @Route("/genre/{id}", name="genre")
     * @param int $id
     * @param GameRepository $gameRepository
     * @param GenreRepository $genreRepository
     * @return JsonResponse
     */
    public function retrieveGameListFromGenre(int $id, GameRepository $gameRepository, GenreRepository $genreRepository)
    {
        $genre = $genreRepository->find($id);

        return $this->json($genre->getGames());


    }

    /**
     * @Route("/genre", name="genreList", methods={"GET"})
     * @param GenreRepository $genreRepository
     * @return JsonResponse
     */
    public function retrieveGenreList(GenreRepository $genreRepository){
        return $this->json($genreRepository->findAll());
    }
}
