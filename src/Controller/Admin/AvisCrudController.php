<?php

namespace App\Controller\Admin;

use App\Entity\Avis;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class AvisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Avis::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInPlural('Liste des avis du garage Perrot')
            ->setEntityLabelInSingular('1 avis')
            ->setPageTitle('index', 'Liste des avis du garage')
            ->setPaginatorPageSize(10)
            ->showEntityActionsInlined();
    }

    
        public function configureFields(string $pageName): iterable
        {
            return [
                TextField::new('nom')->setLabel('Visiteur'),
                TextareaField::new('commentaire')->setMaxLength(500),
                IntegerField::new('note'),
                BooleanField::new('acceptation')->hideOnForm(), // Hide the field on the form
                AssociationField::new('IDemploye')->setLabel('Pris en charge')
                -> setRequired(false),
            ];
        }
   
}
