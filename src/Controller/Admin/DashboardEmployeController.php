<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use App\Entity\Employe;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\DependencyInjection\Loader\Configurator\security;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Config\Doctrine\Orm\EntityManagerConfig\EntityListeners\EntityConfig;

class DashboardEmployeController extends AbstractDashboardController
{

    private $entityManager;

        public function __construct(EntityManagerInterface $entityManager)
        {
            $this->entityManager = $entityManager;
        }

    #[IsGranted('ROLE_USER')]
    #[Route('/admin/employe', name: 'app_employe')]
    public function index(): Response
    {
        //Sécurité pour que l'employé ne devienne jamais administrateur
        $employe = new Employe();
        $employe->setIsAdmin(false);
        return $this->render('security/dashboard_employe.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Contact', 'fa-regular fa-address-card', Contact::class);
    }
}
