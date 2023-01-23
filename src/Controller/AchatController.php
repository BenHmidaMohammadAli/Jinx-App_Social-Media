<?php

namespace App\Controller;

use App\Entity\Achat;
use App\Entity\User;
use App\Form\AchatType;
use App\Repository\AchatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/achat')]
class AchatController extends AbstractController
{
    #[Route('/', name: 'app_achat_index', methods: ['GET'])]
    public function index(AchatRepository $achatRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('achat/index.html.twig', [
            'achats' => $achatRepository->findAll(),
            'user' => $user
        ]);
    }

    #[Route('/new', name: 'app_achat_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AchatRepository $achatRepository): Response
    {
        $user=$this->getUser() ;
        $achat = new Achat();
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achat->setEtat("Pending") ;
            $achatRepository->add($achat);
            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/new.html.twig', [
            'achat' => $achat,
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/{id}', name: 'app_achat_show', methods: ['GET'])]
    public function show(Achat $achat): Response
    {
        $user=$this->getUser() ;
        return $this->render('achat/show.html.twig', [
            'achat' => $achat,
            'user' => $user
        ]);
    }

    #[Route('/{id}/edit', name: 'app_achat_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Achat $achat, AchatRepository $achatRepository): Response
    {
        $user=$this->getUser() ;
        $form = $this->createForm(AchatType::class, $achat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $achatRepository->add($achat);
            return $this->redirectToRoute('app_achat_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('achat/edit.html.twig', [
            'achat' => $achat,
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/{id}', name: 'app_achat_delete', methods: ['POST'])]
    public function delete(Request $request, Achat $achat, AchatRepository $achatRepository): Response
    {
        $user=$this->getUser() ;
        if ($this->isCsrfTokenValid('delete'.$achat->getId(), $request->request->get('_token'))) {
            $achatRepository->remove($achat);
        }

        return $this->redirectToRoute('app_achat_index', ['user' => $user], Response::HTTP_SEE_OTHER);
    }
}
