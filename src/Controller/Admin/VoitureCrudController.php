<?php

namespace App\Controller\Admin;

use App\Entity\Voiture;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoitureCrudController extends AbstractCrudController
{
    
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

   
    public static function getEntityFqcn(): string
    {
        return Voiture::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titre_annonce'),      
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
            AssociationField::new('IDoption')->setLabel('Options'),
            BooleanField::new('IDoption', 'Options')
                ->setFormTypeOptions([
                    'choices' => $this->entityManager->getRepository(\App\Entity\OptionVoiture ::class)->findAll(),
                    'choice_label' => 'nom',
                    'multiple' => true,
                    'expanded' => true,
                ])
        ];
    }
   
}
