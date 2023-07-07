<?php

namespace App\Controller\Admin;

use App\Entity\Marque;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class MarqueCrudController extends AbstractCrudController
{
    
    public function configureCrud (Crud $crud) : Crud
    {
            return $crud
            ->setEntityLabelInPlural('Les marques de voiture')
            ->setEntityLabelInSingular('une marque')
            ->setPageTitle('index', 'Liste des marques de voiture')
            ->setPaginatorPageSize(15)
            ->showEntityActionsInlined();
    }
    public static function getEntityFqcn(): string
    {
        return Marque::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
