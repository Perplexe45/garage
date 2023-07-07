<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use App\Entity\Evocation;
use App\Entity\Horaire;
use App\Entity\InfoSpeciale;
use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardGerantController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin/gerant', name: 'app_admin')]
    public function index(): Response
    {
        
        return $this->render('security/dashboard_admin.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage Parrot')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable  
    {
        yield MenuItem::linktoRoute('Retour sur le site', 'fas fa-home', 'home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Employés', 'fas fa-user', Employe::class);
        
        yield MenuItem::subMenu('Horaires', 'fa-solid fa-car')
            ->setSubItems([
                MenuItem::linkToCrud('Horaires', 'fa-solid fa-clock', Horaire::class),
                MenuItem::linkToCrud('Info spécial', 'fa-solid fa-info', InfoSpeciale::class)
            ]);
        yield MenuItem::subMenu('Services', 'fa-solid fa-car')
            ->setSubItems([
                MenuItem::linkToCrud('Réparations', 'fa-solid fa-bars', Service::class),
                MenuItem::linkToCrud('Noms réparations', 'fa-solid fa-gear', Evocation::class)
            ]);
    }
}
