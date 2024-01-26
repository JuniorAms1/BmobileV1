<?php

namespace App\Form;

use App\Entity\Partner;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePartnerPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    
        ->add('email', EmailType::class, [
            'disabled' => true, 
            'label' => 'Mon adresse email'
        ])
        ->add('nom', TextType::class, [
            'disabled' => false, 
            'label' => "Mon nom d'utilisateur"
        ])
  
        ->add('old_password', PasswordType::class, [
            'mapped' => false,
            'label' => 'Mon mot de passe actuel',
            'attr' => [
                'placeholder' => 'Veuillez renseigner votre mot de passe actuel'
            ]

        ])
        ->add('new_password', RepeatedType::class, [
            'type' => PasswordType::class,
            'mapped' => false,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
            'required' => true,
            'first_options' => [ 
                'label' => 'Mon nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de saisir votre nouveau mot de passe'
                ]
            ],
            'second_options' => [ 
                'label' => 'Confirmer mon nouveau mot de passe',
                'attr' => [
                    'placeholder' => 'Merci de confirmer votre nouveau mot de passe'
                 ]
            ]
            
        ])
        ->add('submit', SubmitType::class, [
            'label' => "Mettre à jour",
            'attr' => [
                'class' => 'btn btn-dark btn-block'
            ]
        ])
    
            
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Partner::class,
        ]);
    }
}
