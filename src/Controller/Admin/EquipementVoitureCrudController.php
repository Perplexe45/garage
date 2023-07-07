<?php

namespace App\Controller\Admin;

use App\Entity\EquipementVoiture;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquipementVoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EquipementVoiture::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
            return $crud
            ->setEntityLabelInPlural('des équipements')
            ->setEntityLabelInSingular('un équipement')
            ->setPageTitle('index', 'Liste des équipements des voitures vendues')
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined();
    }

   

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('IDvoiture')
                ->setRequired(false)
                ->setLabel('Référence de la voiture'),
            AssociationField::new('IDequipement')
                ->setRequired(false)
                ->setLabel('Equipement'),  
        ];
    }
}
