<?php

namespace App\Controller\Admin;

use App\Entity\Employe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use Symfony\Component\Validator\Constraints\Length;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use Symfony\Component\Validator\Constraints\NotBlank;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmployeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employe::class;
    }

    public function configureCrud(Crud $crud): Crud
    {

        return $crud
            ->setEntityLabelInPlural('Les employés du garage')
            ->setEntityLabelInSingular('un employé')
            ->setPageTitle('index', 'Garage Parrot - Administration des employés')
            ->setPaginatorPageSize(10)
            ->showEntityActionsInlined();
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->hideOnForm();
        yield TextField::new('nom')->setLabel('Nom');
        yield TextField::new('prenom')->setLabel('Prénom');
        yield TextField::new('adresse')->setLabel('Adresse');
        yield NumberField::new('code_postal')->setLabel('Code Postal');
        yield TextField::new('Ville');
        yield TextField::new('telephone')->setLabel('Téléphone');
        yield EmailField::new('email');
        yield ArrayField::new('roles')  
            ->hideOnIndex();

        if ($pageName === Crud::PAGE_NEW || $pageName === Crud::PAGE_EDIT) {
            yield TextField::new('password')
                ->setLabel('Mot de passe')
                ->setFormType(RepeatedType::class)
                ->setFormTypeOptions([
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les mots de passe doivent correspondre.',
                    'required' => true,
                    'first_options' => ['label' => 'Mot de passe'],
                    'second_options' => ['label' => 'Confirmer le mot de passe'],
                    'constraints' => [
                        new NotBlank(),
                        new Length(['min' => 6]),
                    ],
                ])
                ->setRequired(true)
                ->hideWhenUpdating();
            }
    }
}