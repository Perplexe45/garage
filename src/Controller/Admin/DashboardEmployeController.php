<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use App\Entity\Contact;
use App\Entity\Equipement;
use App\Entity\Voiture;
use App\Entity\GallerieImage;
use App\Entity\Option;
use App\Entity\Options;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

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
        yield MenuItem::linkToCrud('Demande de contact', 'fa-regular fa-address-card', Contact::class);
       
        yield MenuItem::subMenu('Ventes véhicules', 'fa-solid fa-car')
            ->setSubItems([
                MenuItem::linkToCrud('Voitures en vente', 'fa-solid fa-car', Voiture::class),
                MenuItem::linkToCrud('Gallery d\'images', 'fa-solid fa-image', GallerieImage::class),
                MenuItem::linkToCrud('Ajout options', 'fa-solid fa-bars', Options::class),
                MenuItem::linkToCrud('Ajout équipements', 'fa-solid fa-gear', Equipement::class)
            ]);

        yield MenuItem::subMenu('Customisation', 'fa-solid fa-car')
            ->setSubItems([
               
                MenuItem::linkToCrud('Les options', 'fa-solid fa-bars', Options::class),
                MenuItem::linkToCrud('Les équipements', 'fa-solid fa-gear', Equipement::class)
            ]);
        yield MenuItem::linkToCrud('Avis des clients', 'fa-solid fa-address-book', Avis::class);
        
    }
}
