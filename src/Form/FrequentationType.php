<?php

namespace App\Form;

use App\Entity\Frequentation;
use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FrequentationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
      
            ->add('montant', NumberType::class, [
                'label' => 'Montant'
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Sauvegarder",
                'attr' => [
                    'class' => 'btn btn-black btn-md'
                ]
            ])
            

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Frequentation::class,
        ]);
    }
}
