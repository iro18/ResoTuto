<?php

namespace App\Controller;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;

use App\Entity\Tutorial;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class TutorialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Tutorial::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('id')->onlyOnIndex(),
            Field::new('order_menu'),
            Field::new('title'),
            Field::new('Content')->hideOnIndex(),
            AssociationField::new('category'),
            Field::new('VideoLink')->hideOnIndex(),
            Field::new('isPublish'),
            Field::new('PublishAt'),

        ];
    }
    
}
