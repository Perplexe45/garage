<?php

namespace App\Controller\Admin;

use App\Entity\OptionVoiture;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OptionVoiture2CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return OptionVoiture::class;
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
