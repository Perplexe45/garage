<?php

namespace App\Controller\Admin;
use App\Entity\OptionVoiture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;    
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OptionVoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OptionVoiture::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
            return $crud
            ->setEntityLabelInPlural('Les options')
            ->setEntityLabelInSingular('une option')
            ->setPageTitle('index', 'Liste des options des voitures vendues')
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('IDvoiture')
                ->setRequired(false)
                ->setLabel('Référence de la voiture'),
            AssociationField::new('IDoptions')
                ->setRequired(false)
                ->setLabel('Option'),  
        ];
    }
}
