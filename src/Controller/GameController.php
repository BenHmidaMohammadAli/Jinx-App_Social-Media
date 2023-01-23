<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/game')]
class GameController extends AbstractController
{
    #[Route('/', name: 'app_game_index', methods: ['GET'])]
    public function index(GameRepository $gameRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('game/index.html.twig', [
            'games' => $gameRepository->findAll(),
            'user' => $user,
        ]);
    }
    #[Route('/sponsor', name: 'app_game_index_sponsor', methods: ['GET'])]
    public function indexSponsor(GameRepository $gameRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('game/indexSponsor.html.twig', [
            'games' => $gameRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_game_new', methods: ['GET', 'POST'])]
    public function new(Request $request, GameRepository $gameRepository): Response
    {
        $user=$this->getUser() ;
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameRepository->add($game);
            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('game/new.html.twig', [
            'game' => $game,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_game_show', methods: ['GET'])]
    public function show(Game $game): Response
    {
        $user=$this->getUser() ;
        return $this->render('game/show.html.twig', [
            'game' => $game,
            'user' => $user,
        ]);
    }

    #[Route('/Sponsor/{id}', name: 'app_game_show_sponsor', methods: ['GET'])]
    public function showSponsor(Game $game): Response
    {
        $user=$this->getUser() ;
        return $this->render('game/showSponsor.html.twig', [
            'game' => $game,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_game_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        $user=$this->getUser() ;
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gameRepository->add($game);
            return $this->redirectToRoute('app_game_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('game/edit.html.twig', [
            'game' => $game,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_game_delete', methods: ['POST'])]
    public function delete(Request $request, Game $game, GameRepository $gameRepository): Response
    {
        $user=$this->getUser() ;
        if ($this->isCsrfTokenValid('delete'.$game->getId(), $request->request->get('_token'))) {
            $gameRepository->remove($game);
        }

        return $this->redirectToRoute('app_game_index', ['user' => $user,], Response::HTTP_SEE_OTHER);
    }
}
