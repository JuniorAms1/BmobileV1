<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 25
                ]),
                'attr' => [
                        'placeholder' => 'Merci de saisir votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 25
                ]),
                'attr' => [
                        'placeholder' => 'Merci de saisir votre nom'
                ]
            ])
            ->add('tel', TelType::class, [
                'label' => 'Quelle est votre numéro de téléphone',
                'attr' => [
                    'placeholder' => 'Entrez votre numéro'
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Quelle est votre adresse',
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre lieu de livraison souhaité'
                ]
            ])
            ->add('referal', NumberType::class, [
                'label' => 'Code de parrainage(Optionnel)',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Veuillez entrer un code de parrainage si vous en avez'
                ]
                
                
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => false,
                'widget' => 'choice',
                'input'  => 'datetime_immutable',
              
            ])
            ->add('modePaiement', ChoiceType::class, [
                'label' => false,
                'choices' => [
                        'A la livraison' => 'At delivery',
                        'Baba Cash' => 'B-mobile Transfer', 
                        
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre Email',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 40
                ]),
                'attr' => [
                        'placeholder' => 'Merci de saisir votre adresse email '
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => new Length([
                    'min' => 5,
                    'max' => 60
                ]),
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'required' => true,
                'first_options' => [ 
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de saisir votre mot de passe'
                    ]
                ],
                'second_options' => [ 
                    'label' => 'Confirmer votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Merci de confirmer votre mot de passe'
                     ]
                ]
                
            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
                'attr' => [
                    'class' => 'btn btn-dark btn-lg btn-block'
                ]
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
