<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/role')]
class RoleController extends AbstractController
{
    #[Route('/', name: 'app_role_index', methods: ['GET'])]
    public function index(RoleRepository $roleRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('role/index.html.twig', [
            'roles' => $roleRepository->findAll(),
            'user' => $user
        ]);
    }

    #[Route('/new', name: 'app_role_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RoleRepository $roleRepository): Response
    {
        $user=$this->getUser() ;
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $roleRepository->add($role);
            return $this->redirectToRoute('app_role_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('role/new.html.twig', [
            'role' => $role,
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/{id}', name: 'app_role_show', methods: ['GET'])]
    public function show(Role $role): Response
    {
        $user=$this->getUser() ;
        return $this->render('role/show.html.twig', [
            'role' => $role,
            'user' => $user
        ]);
    }

    #[Route('/{id}/edit', name: 'app_role_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Role $role, RoleRepository $roleRepository): Response
    {
        $user=$this->getUser() ;
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $roleRepository->add($role);
            return $this->redirectToRoute('app_role_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('role/edit.html.twig', [
            'role' => $role,
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('/{id}', name: 'app_role_delete', methods: ['POST'])]
    public function delete(Request $request, Role $role, RoleRepository $roleRepository): Response
    {
        $user=$this->getUser() ;
        if ($this->isCsrfTokenValid('delete'.$role->getId(), $request->request->get('_token'))) {
            $roleRepository->remove($role);
        }

        return $this->redirectToRoute('app_role_index', ['user' => $user], Response::HTTP_SEE_OTHER);
    }
}
