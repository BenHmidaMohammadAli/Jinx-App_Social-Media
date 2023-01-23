<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index(EventRepository $eventRepository): Response
    {
        $user=$this->getUser() ;
        return $this->render('event/index.html.twig', [
            'events' => $eventRepository->findAll(),
            'user' => $user,
        ]);
    }
    #[Route('/Sponsor/{id}', name: 'app_event_index_sponsor', methods: ['GET'])]
    public function indexSponsor(EventRepository $eventRepository, User  $user): Response
    {
        $user1=$this->getUser() ;
        return $this->render('event/indexSponsor.html.twig', [
            'events' => $eventRepository->findBy(array('Creator' => $user)),
            'user' => $user1,
        ]);
    }

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EventRepository $eventRepository): Response
    {
        $user=$this->getUser() ;
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventRepository->add($event);
            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/Sponsor/new', name: 'app_event_new_Sponsor', methods: ['GET', 'POST'])]
    public function newSponsor(Request $request, EventRepository $eventRepository): Response
    {
        $user=$this->getUser() ;
        $id=$user->getId();

        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setCreator($user);
            $eventRepository->add($event);
            return $this->redirectToRoute('app_event_index_sponsor', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/newSponsor.html.twig', [
            'event' => $event,
            'form' => $form,
            'user' => $user,
        ]);
    }


    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        $user=$this->getUser() ;
        return $this->render('event/show.html.twig', [
            'event' => $event,
            'user' => $user,
        ]);
    }
    #[Route('/SponsorShow/{id}', name: 'app_event_show_sponsor', methods: ['GET'])]
    public function showSponsor(Event $event): Response
    {
        $user=$this->getUser() ;
        return $this->render('event/showSponsor.html.twig', [
            'event' => $event,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        $user=$this->getUser() ;
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventRepository->add($event);
            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
            'user' => $user,
        ]);
    }



    #[Route('/sponsor/{id}/edit', name: 'app_event_edit_sponsor', methods: ['GET', 'POST'])]
    public function editSponsor(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        $user=$this->getUser() ;
        $id = $user->getId();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventRepository->add($event);
            return $this->redirectToRoute('app_event_index_sponsor', ['id'=>$id], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/editSponsor.html.twig', [
            'event' => $event,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EventRepository $eventRepository): Response
    {
        $user=$this->getUser() ;
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $eventRepository->remove($event);
        }

        return $this->redirectToRoute('app_event_index', ['user' => $user,], Response::HTTP_SEE_OTHER);
    }
}
