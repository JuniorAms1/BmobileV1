<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class ChangeProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'disabled' => true, 
            'label' => 'Mon adresse email'
        ])
           
        ->add('firstname', TextType::class, [
            'label' => 'Mon prénom',
            'disabled' => true, 
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Mon nom',
            'disabled' => true, 
        ])
        ->add('tel', TelType::class, [
            'label' => 'Mon nouveau numéro de téléphone',
            'attr' => [
                'placeholder' => 'Mon nouveau numéro'
            ]
        ])
        ->add('adresse', TextType::class, [
            'label' => 'Ma nouvelle adresse',
            'attr' => [
                'placeholder' => 'Mon nouveau lieu de livraison souhaité'
            ]
        ])
        ->add('birthday', BirthdayType::class, [
            'disabled' => true,
            'label' => false,
        ])
        ->add('submit', SubmitType::class, [
            'label' => "Mettre à jour",
            'attr' => [
                'class' => 'btn btn-danger btn-block'
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
