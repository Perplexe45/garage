<?php

namespace App\Controller\Admin;

use App\Entity\Evocation;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class EvocationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Evocation::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInPlural('Les types de service')
            ->setEntityLabelInSingular('une prestation')
            ->setPageTitle('index', 'Prestations de service du garage')
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('IDservice')->setLabel('Réparation'),
            TextField::new('nom'),
            NumberField::new('prix')
        ];
    }
}
