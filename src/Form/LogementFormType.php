<?php

namespace App\Form;

use App\Entity\Logement;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogementFormType extends AbstractType
{

    public function buildForm( FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('refLogement', EntityType::class,[
                'class'=>Logement::class,
                'placeholder'=> 'Logement',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
