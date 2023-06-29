<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class VoitureCrudController extends AbstractCrudController
{
      
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
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
          /*   TextField::new('Titre_annonce'), */
            TextField::new('Reference'),
            MoneyField::new('prix')->setCurrency('EUR'),
            ImageField::new('image')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),  
            NumberField::new('mise_en_circulation')->setLabel('mise en circulation'),
            NumberField::new('kilometre')->setlabel('km'),
            AssociationField::new('IDemploye')->setLabel('Employé'),
            AssociationField::new('IDgallerie_image')->setLabel('nom dans gallerie'),
            BooleanField::new('vendu')

            
        ];
    }
}
