<?php

namespace App\Controller\Admin;

use App\Entity\Carte;
use App\Entity\Partner;
use App\Entity\Enseigne;
use App\Entity\Structure;
use App\Entity\Categories;
use App\Entity\EnseigneDetails;
use App\Entity\Membre;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
      
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BmobileV1');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Membre::class);
        yield MenuItem::linkToCrud('Carte B-mobile', 'fas fa-credit-card', Carte::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Categories::class);
        yield MenuItem::linkToCrud('Enseignes', 'fas fa-tag', Enseigne::class);
        yield MenuItem::linkToCrud('Détails sur Enseignes', 'fas fa-info-circle', EnseigneDetails::class);
        yield MenuItem::linkToCrud('Structure', 'fas fa-building', Structure::class);
        yield MenuItem::linkToCrud('Partenaire', 'fas fa-duotone fa-handshake', Partner::class);

    }
}
