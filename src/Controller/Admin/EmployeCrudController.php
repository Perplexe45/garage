<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class EmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employe::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInPlural('Employés')
            ->setEntityLabelInSingular('Employé')
            ->setPageTitle('index', 'Garage Parrot - Administration des employés')
            ->setPaginatorPageSize(10);
    }



    public function configureFields(string $pageName): iterable
    {   
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom')->setLabel('Nom'),
            TextField::new('prenom')->setLabel('Prénom'),
            TextField::new('adresse')->setLabel('Adresse'),
            NumberField::new('code_postal')->setLabel('Code Postal'),
            TextField::new('Ville'),
            TextField::new('telephone')->setLabel('Téléphone'),
            EmailField::new('email')
                ->setFormTypeOption('disabled','disabled'),
            TextField::new('password')->setLabel('Mot de passe')
                ->hideOnIndex(),
            
        ];
    }

   
}