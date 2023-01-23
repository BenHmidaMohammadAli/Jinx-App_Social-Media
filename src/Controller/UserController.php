<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/indexAdmin', name: 'app_admin_index', methods: ['GET'])]
    public function indexAdmin(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/index.html.twig', [
            'users'=> $userRepository->findBy(array('Role' => 1)),
            'Role'=>'List of admins',
            'RoleID'=>1,
            'user' => $user
        ]);
    }
    #[Route('/Sponsor/indexDev', name: 'app_dev_index_sponsor', methods: ['GET'])]
    public function indexDevSponsor(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/indexSponsor.html.twig', [
            'users'=> $userRepository->findBy(array('Role' => 3)),
            'Role'=>'List of Developper',
            'RoleID'=>3,
            'user' => $user
        ]);
    }
    #[Route('/Sponsor/indexGamer', name: 'app_gamer_index_sponsor', methods: ['GET'])]
    public function indexGamerSponsor(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/indexSponsor.html.twig', [
            'users'=> $userRepository->findBy(array('Role' => 4)),
            'Role'=>'List of Gamer',
            'RoleID'=>4,
            'user' => $user
        ]);
    }

    #[Route('/indexSponsor', name: 'app_sponsor_index', methods: ['GET'])]
    public function indexSponsor(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/index.html.twig', [
            'users'=> $userRepository->findBy(array('Role' => 2)),
            'Role'=>'List of sponsors',
            'RoleID'=>2,
            'user' => $user
        ]);
    }

    #[Route('/indexDevloppers', name: 'app_dev_index', methods: ['GET'])]
    public function indexDev(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/index.html.twig', [
            'users'=> $userRepository->findBy(array('Role' => 3)),
            'Role'=>'List of Developpers',
            'RoleID'=>3,
            'user' => $user
        ]);
    }
    #[Route('/indexGamers', name: 'app_gamer_index', methods: ['GET'])]
    public function indexGamer(UserRepository $userRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('user/index.html.twig', [
            'users'=> $userRepository->findBy(array('Role' => 4)),
            'Role'=>'List of Gamers',
            'RoleID'=>4,
            'user' => $user
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/new.html.twig', [
            'user' => $user,
            'form' => $form,

        ]);
    }

    #[Route('/admin/{id}', name: 'app_admin_show', methods: ['GET'])]
    public function showAdmin(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'Role'=>'Admin',
            'user' => $user,
            'RoleID'=>1,
        ]);
    }
    #[Route('/sponsor/{id}', name: 'app_sponsor_show', methods: ['GET'])]
    public function showSponsor(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'Role'=>'Sponsor',
            'user' => $user,
            'RoleID'=>2,
        ]);
    }



    #[Route('/Dev/{id}', name: 'app_dev_show', methods: ['GET'])]
    public function showDev(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'Role'=>'Developper',
            'user' => $user,
            'RoleID'=>3,
        ]);
    }

    #[Route('Sponsor/Dev/{id}', name: 'app_dev_show_Sponsor', methods: ['GET'])]
    public function showDevSponsor(User $user): Response
    {
        return $this->render('user/showSponsor.html.twig', [
            'Role'=>'Developper',
            'user' => $user,
            'RoleID'=>3,
        ]);
    }

    #[Route('/gamer/{id}', name: 'app_gamer_show', methods: ['GET'])]
    public function showGamer(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'Role'=>'Gamers',
            'user' => $user,
            'RoleID'=>4,
        ]);
    }






    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/editSposnorProfil', name: 'app_user_editSposnorProfil', methods: ['GET', 'POST'])]
    public function editSposnorProfil(Request $request, User $user, UserRepository $userRepository): Response
    {
        $user= $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user);
            return $this->redirectToRoute('ShowProfilSponsor', ['user'=>$user], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('user/editSponsorProfil.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_user_index', ['user' => $user,], Response::HTTP_SEE_OTHER);
    }
}
