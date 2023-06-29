<?php

namespace App\Controller\Admin;

use App\Entity\Horaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class HoraireCrudController extends AbstractCrudController
{

    public function configureCrud (Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les horaires du garage')
            ->setEntityLabelInSingular('un horaire')
            ->setPageTitle('index', 'Horaires du garage')
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined();
    }

    public static function getEntityFqcn(): string
    {
        return Horaire::class;
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
