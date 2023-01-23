<?php

namespace App\Controller;
use App\Entity\Annonce;
use App\Entity\User;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/annonce')]
class AnnonceController extends AbstractController
{
    #[Route('/', name: 'app_annonce_index', methods: ['GET'])]
    public function index(AnnonceRepository $annonceRepository): Response
    {
        $user=$this->getUser() ;
        $em =$this->getDoctrine()->getManager();
        $ListeUsers=$em->getRepository("App\Entity\User")->findAll();

        return $this->render('annonce/index.html.twig', [
            'annonces' => $annonceRepository->findAll(),
            'user' => $user,
            'users'=> $ListeUsers
        ]);
    }

    #[Route('/Sponsor/{id}', name: 'app_annonce_index_sponsor', methods: ['GET'])]
    public function indexSponsor(AnnonceRepository $annonceRepository, User  $user): Response
    {
        $user=$this->getUser() ;
        $em =$this->getDoctrine()->getManager();
        $ListeUsers=$em->getRepository("App\Entity\User")->findAll();

        return $this->render('annonce/indexSponsor.html.twig', [
            'annonces' => $annonceRepository->findBy(array('user' => $user)),
            'user' => $user,
            'users'=> $ListeUsers
        ]);
    }

    #[Route('/new', name: 'app_annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $user=$this->getUser() ;
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateNow = date('d-m-y') ;

            $annonce->setDate(\DateTime::createFromFormat('d-m-y',$dateNow));
            $annonce->setUser($user);

            $annonceRepository->add($annonce);
            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
            'user' => $user
        ]);
    }


    #[Route('/new/Sponsor', name: 'app_annonce_new_sponsor', methods: ['GET', 'POST'])]
    public function newSponsor(Request $request, AnnonceRepository $annonceRepository): Response
    {
        $user=$this->getUser() ;
        $id = $user->getId();
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dateNow = date('d-m-y') ;

            $annonce->setDate(\DateTime::createFromFormat('d-m-y',$dateNow));
            $annonce->setUser($user);

            $annonceRepository->add($annonce);
            return $this->redirectToRoute('app_annonce_index_sponsor', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/newSponsor.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
            'user' => $user
        ]);
    }




    #[Route('/{id}', name: 'app_annonce_show', methods: ['GET'])]
    public function show(Annonce $annonce): Response
    {
        $user=$this->getUser() ;
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
            'user' => $user
        ]);
    }

    #[Route('/sponsor/{id}', name: 'app_annonce_show_sponsor', methods: ['GET'])]
    public function showSponsor(Annonce $annonce): Response
    {
        $user=$this->getUser() ;
        return $this->render('annonce/showSponsor.html.twig', [
            'annonce' => $annonce,
            'user' => $user
        ]);
    }

    #[Route('/{id}/edit', name: 'app_annonce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository): Response
    {
        $user=$this->getUser() ;
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonceRepository->add($annonce);
            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
            'user' => $user
        ]);
    }

    #[Route('sponsor/{id}/edit', name: 'app_annonce_edit_sponsor', methods: ['GET', 'POST'])]
    public function editSponsor(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository): Response
    {
        $user=$this->getUser() ;
        $id=$user->getId();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonceRepository->add($annonce);
            return $this->redirectToRoute('app_annonce_index_sponsor', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/editSponsor.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
            'user' => $user
        ]);
    }



    #[Route('/{id}', name: 'app_annonce_delete', methods: ['POST'])]
    public function delete(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository): Response
    {
        $user=$this->getUser() ;
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $annonceRepository->remove($annonce);
        }

        return $this->redirectToRoute('app_annonce_index', ['user' => $user], Response::HTTP_SEE_OTHER);
    }
}
