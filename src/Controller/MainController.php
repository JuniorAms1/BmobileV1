<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/mes-avantages', name: 'app_avantage')]
    public function avantage(): Response
    {
        return $this->render('main/avantages.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/ma-carte-Bmobile', name: 'app_lacarte')]
    public function lacarte(): Response
    {
        return $this->render('main/lacarte.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/profile-mobile', name: 'app_profilmobile')]
    public function profilemobile(): Response
    {
        return $this->render('main/profilemobile.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
