<?php

namespace App\Controller;

use App\Repository\GroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GeneralController extends AbstractController
{
    /**
     * @Route ("/ShowMyProfil", name="ShowMyProfil")
     */
    public function ShowMyProfil(GroupRepository $groupRepository): Response
    {
        $user=$this->getUser();
        return $this->render('AboutMe.html.twig',
            [
                'date'=>date('H:i:s \O\n d/m/Y'),
                'groups'=>$groupRepository->findAll(),
                'user'=>$user,
            ]);
    }

    /**
     * @Route ("/AcceuilGamer", name="AcceuilGamer")
     */
    public function AcceuilGamer(GroupRepository $groupRepository): Response
    {

        $user=$this->getUser();

      return $this->render('Template-AcceuilGamer.html.twig',
            [
                'date'=>date('H:i:s \O\n d/m/Y'),
                'groups'=>$groupRepository->findAll(),
                'user'=>$user,

            ]);
    }
    /**
     * @Route ("/AcceuilDev", name="AcceuilDev")
     */
    public function AcceuilDev(GroupRepository $groupRepository): Response
    {
        $user=$this->getUser();
        return $this->render('Template-AcceuilDev.html.twig',
            [
                'date'=>date('H:i:s \O\n d/m/Y'),
                'groups'=>$groupRepository->findAll(),
                'user'=>$user,
            ]);
    }

    /**
     * @Route ("/DashboardAdmin", name="DashboardAdmin")
     */
    public function DashboardAdmin(): Response
    {
        $user=$this->getUser() ;
        return $this->render('dashboardAdmin.html.twig',
            ['user' => $user]);
    }

    /**
     * @Route ("DashboardAdmin/ShowProfil", name="ShowProfil")
     */
    public function ShowProfil(): Response
    {
        $user=$this->getUser() ;
        return $this->render('Template-profil.html.twig',
            ['user' => $user,]);
    }
    /**
     * @Route ("DashboardSponsor/ShowProfil", name="ShowProfilSponsor")
     */
    public function ShowProfilSponsor(): Response
    {
        $user=$this->getUser() ;
        return $this->render('Template-profilSponsor.html.twig',
            ['user' => $user,]);
    }

    /**
     * @Route ("DashboardAdmin/Statics", name="Statics")
     */
    public function Statics(): Response
    {
        $user=$this->getUser() ;
        return $this->render('Statics.html.twig', ['user' => $user,]);
    }

    /**
     * @Route ("DashboardSponsor/Statics", name="StaticsSponsor")
     */
    public function StaticsSponsor(): Response
    {
        $user=$this->getUser() ;
        return $this->render('StaticsSponsor.html.twig', ['user' => $user,]);
    }
    /**
     * @Route ("/DashboardSponsor", name="DashboardSponsor")
     */
    public function DashboardSponsor(): Response
    {
        $user=$this->getUser() ;
        return $this->render('dashboardSponsor.html.twig',
            ['user' => $user,]);
    }


    /**
     * @Route ("DashboardAdmin/Contact", name="Contact")
     */
    public function Contact(): Response
    {
        $user=$this->getUser() ;
        return $this->render('contact.html.twig',
            ['user' => $user,]);
    }


}
