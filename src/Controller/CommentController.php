<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Game;
use App\Repository\CommentRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    /**
     * @Route("/game/{id}/comment", name="getAllComment", methods={"GET"})
     * @param GameRepository $gameRepository
     * @param CommentRepository $commentRepository
     * @param $id
     * @return JsonResponse
     */
    public function retrieveComments(
        GameRepository $gameRepository,
        CommentRepository $commentRepository,
        int $id)
    {
        return $this->json($commentRepository->findBy([
            'game' => $id
        ]));
    }

    /**
     * @Route ("game/{id}/comment", name="postComment", methods={"POST"})
     * @param Request $request
     * @param GameRepository $gameRepository
     * @return JsonResponse
     */

    public function postComment(Request $request, GameRepository $gameRepository){

        $idGame = $request->attributes->get('id');

        $entityManager = $this->getDoctrine()->getManager();

        $comment = new Comment();
        $comment->setContent($request->request->get('content'));
        $comment->setGame($gameRepository->find($idGame));

        $entityManager->persist($comment);
        $entityManager->flush();

        return $this->json($comment);

    }

    /**
     * @Route ("game/{id}/comment", name="deleteComment", methods={"DELETE"})
     * @param Request $request
     * @param GameRepository $gameRepository
     * @param CommentRepository $commentRepository
     * @return JsonResponse
     */
    public function deleteComment(Request $request,
                                  GameRepository $gameRepository,
                                  CommentRepository $commentRepository
    )
    {
        $idComment = $request->query->get('IDComment');

        $entityManager = $this->getDoctrine()->getManager();

        $commentToDelete = $commentRepository->find($idComment);
        $entityManager->remove($commentToDelete);
        $entityManager->flush();

      return $this->json($idComment);
    }
}
