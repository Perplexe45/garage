<?php

namespace App\Controller\Admin;

use App\Entity\EquipementVoiture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EquipementVoitureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EquipementVoiture::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
