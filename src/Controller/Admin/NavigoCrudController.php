<?php

namespace App\Controller\Admin;

use App\Entity\Navigo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class NavigoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Navigo::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Formules Navigo')
            ->setEntityLabelInSingular('Formule Navigo');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')
                ->hideOnForm(),
            IntegerField::new('nbjours'),
            IntegerField::new('prix')
        ];
    }

}
