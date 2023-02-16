<?php

namespace App\Controller;

use App\Repository\CategoriesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'categories' => $categoriesRepository->findBy([])
        ]);
    }

    #[Route('/devenir-partenaire', name: 'app_devenir_partenaire')]
    public function partenariat(): Response
    {
        return $this->render('main/devenir_partenaire.html.twig', [
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
