<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('provenance', ChoiceType::class, array(
                'placeholder' => 'Provenance',
                'choices'  =>
                    [
                        'MIAGE Aix Marseille' => 'MIAGE Aix Marseille',
                        'MIAGE Amiens' => 'MIAGE Amiens',
                        'MIAGE Antilles' => 'MIAGE Antilles',
                        'MIAGE Bordeaux' => 'MIAGE Bordeaux',
                        'MIAGE Grenoble' => 'MIAGE Grenoble',
                        'MIAGE Lille' => 'MIAGE Lille',
                        'MIAGE Lyon' => 'MIAGE Lyon',
                        'MIAGE Mulhouse' => 'MIAGE Mulhouse',
                        'MIAGE Nancy' => 'MIAGE Nancy',
                        'MIAGE Nantes' => 'MIAGE Nantes',
                        'MIAGE Nice' => 'MIAGE Nice',
                        'MIAGE Nouvelle-Calédonie' => 'MIAGE Nouvelle-Calédonie',
                        'MIAGE Orléans' => 'MIAGE Orléans',
                        'MIAGE Paris Dauphine' => 'MIAGE Paris Dauphine',
                        'MIAGE Paris Descartes' => 'MIAGE Paris Descartes',
                        'MIAGE Paris Nanterre' => 'MIAGE Paris Nanterre',
                        'MIAGE Paris Saclay/Evry' => 'MIAGE Paris Saclay/Evry',
                        'MIAGE Paris Saclay/Orsay' => 'MIAGE Paris Saclay/Orsay',
                        'MIAGE Paris Sorbonne' => 'MIAGE Paris Sorbonne',
                        'MIAGE Rennes' => 'MIAGE Rennes',
                        'MIAGE Toulouse' => 'MIAGE Paris Toulouse',

                    ],
            ))
            ->add('numTel')
            ->add('dateNaissance')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
