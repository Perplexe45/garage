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
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VoitureCrudController extends AbstractCrudController
{
      
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInPlural('Vente des véhicules du garage')
            ->setEntityLabelInSingular('une vente')
            ->setPageTitle('index', 'Vente des véhicules du garage')
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined();
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        return [
            TextField::new('reference')
                ->setLabel('Référence annonce')
                ->setFormType(TextType::class)
                ->setFormTypeOptions(['attr' => ['class' => 'w-75']]),
            TextField::new('caracteristique')
                ->setLabel('Caractéristique')
                ->setFormType(TextType::class)
                ->setFormTypeOptions(['attr' => ['class' => 'w-75']]),

            AssociationField::new('IDmarque')
                ->setLabel('Marque')
                ->setRequired(false)
                ->setFormTypeOptions(['attr' => ['class' => 'w-50']]),
            AssociationField::new('IDmodele')
                ->setLabel('Modèle')
                ->setRequired(false)
                ->setFormTypeOptions(['attr' => ['class' => 'w-50']]),
            NumberField::new('kilometre')
                ->setlabel('km')
                ->setFormTypeOptions(['attr' => ['class' => 'w-50']]),
            MoneyField::new('prix')->setCurrency('EUR')
            ->setFormTypeOptions(['attr' => ['class' => 'w-25']]),
            ImageField::new('image')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false)
            ->setFormTypeOptions(['attr' => ['class' => 'w-50']]),
            NumberField::new('circulation')
                ->setLabel('mise en circulation'),
            AssociationField::new('IDgallerie_image')
                ->setLabel('nom dans gallerie')
                ->setRequired(false)
                ->setFormTypeOptions(['attr' => ['class' => 'w-50']]),
            AssociationField::new('IDemploye')
                ->setLabel('Employé')
                ->setRequired(false)
                ->setFormTypeOptions(['attr' => ['class' => 'w-50']]),
            BooleanField::new('vendu')
        ];
    }
}
