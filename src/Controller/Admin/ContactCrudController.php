<?php

namespace App\Controller\Admin;


use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }


    public function configureCrud (Crud $crud) : Crud
    {
            return $crud
            ->setEntityLabelInPlural('Contacts')
            ->setEntityLabelInSingular('contact')
            ->setPageTitle('index', 'Liste des contacts du garage')
            ->setPaginatorPageSize(15);
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('IDvoiture')->setLabel('Référence de l\'annonce (Si intérêt pour achat d\'une voiture)'),
            TextField::new('nom'),
            TextField::new('prenom'),
            EmailField::new('email'),
            TelephoneField::new('telephone'),
            TextareaField::new('message'),
            AssociationField::new('IDemploye')->setLabel('Gérer par')
        ];
    }


   
}
