<?php

namespace App\Controller\Admin;

use App\Entity\GallerieImage;

use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
class GallerieImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return GallerieImage::class;
    }

    public function configureCrud (Crud $crud) : Crud
    {
        return $crud
            ->setEntityLabelInPlural('une gallerie')
            ->setEntityLabelInSingular('une gallerie de photos')
            ->setPageTitle('index', 'Liste des galleries de photos pour vente de véhicules')
            ->setPaginatorPageSize(10)
            ->showEntityActionsInlined();

    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom')->setLabel('nom'),

            ImageField::new('img1')
            ->setBasePath('uploads/')
            ->setUploadDir('public/uploads')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),   
            ImageField::new('img2')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false), 
            ImageField::new('img3')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false), 
            ImageField::new('img4')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false), 
            ImageField::new('img5')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false), 
            ImageField::new('img6')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false), 
             
        ];
    }
   
}   
