<?php

namespace App\Controller\Admin;

use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UtilisateurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Utilisateur::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')
                ->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            TextField::new('num_Tel')
                ->hideOnindex(),
            TextField::new('email')
                ->setFormTypeOption('disabled','disabled'),
            TextField::new('adresse')
                ->hideOnIndex(),
            TextField::new('date_naissance')
                ->hideOnIndex(),
            AssociationField::new('refVideo')->setCrudController(VideoCrudController::class)
                ->hideOnForm(),
            AssociationField::new('refNavigo')->setCrudController(NavigoCrudController::class)
                ->hideOnForm(),
            AssociationField::new('refLogement')->setCrudController(LogementCrudController::class)
                ->hideOnForm(),
        ];
    }
}
