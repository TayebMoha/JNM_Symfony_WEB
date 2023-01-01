<?php

namespace App\Controller\Admin;

use App\Entity\Logement;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LogementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Logement::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Logements')
            ->setEntityLabelInSingular('Logement');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')
                ->hideOnForm(),
            TextField::new('type_l'),
            TextEditorField::new('description')
                ->hideOnIndex(),
            NumberField::new('prix'),
            TextField::new('ville'),

        ];
    }

}
