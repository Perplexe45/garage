<?php

namespace App\Controller\Admin;

use App\Entity\InfoSpeciale;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class InfoSpecialeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfoSpeciale::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
             TextareaField::new('designation')->setMaxLength(1000),
        
        ];
    }
}
