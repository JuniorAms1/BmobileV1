<?php

namespace App\Controller\Admin;

use App\Entity\Partner;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\{EmailField, TextField};
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use Symfony\Component\Form\Extension\Core\Type\{PasswordType, RepeatedType};


class PartnerCrudController extends AbstractCrudController
{
    private $partnerPasswordHasher;

    public function __construct(
        UserPasswordHasherInterface $partnerPasswordHasher
    ) {
        $this->partnerPasswordHasher = $partnerPasswordHasher;
    }
    // Depuis php 8.0.0 on peut faire like that
     /*
                public function __construct(
                public UserPasswordHasherInterface $userPasswordHasher
            ) {}
     */

    public static function getEntityFqcn(): string
    {
        return Partner::class;
    }
    public function configureActions(Actions $actions): Actions
{
    return $actions
        // ...
        ->add('index', 'detail')
    ;
}

 
    public function configureFields(string $pageName): iterable
    {
       // Surcharger la configuration des fields
        $fields = [
            AssociationField::new('structure'),
            TextField::new('nom'),
            EmailField::new('email'),
            TextareaField::new('offre')->onlyOnDetail(),
           
        ];

        $password = TextField::new('password')
            ->setFormType(RepeatedType::class)
            ->setFormTypeOptions([
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Password'],
                'second_options' => ['label' => '(Repeat)'],
                'mapped' => false,
            ])
            ->setRequired($pageName === Crud::PAGE_NEW)
            ->onlyOnForms()
            ;
        $fields[] = $password;

        return $fields;
        
    }


     // Ecouter les requêtes
    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        return $this->addPasswordEventListener($formBuilder);
    }

    private function addPasswordEventListener(FormBuilderInterface $formBuilder): FormBuilderInterface
    {
        return $formBuilder->addEventListener(FormEvents::POST_SUBMIT, $this->hashPassword());
    }

        // Hash password 
    private function hashPassword() {
        return function($event) {
            $form = $event->getForm();
            if (!$form->isValid()) {
                return;
            }
            
            $partner = $form->getData();
            $password = $form->get('password')->getData();
            if ($password === null) {
                return;
            }

            $hash = $this->partnerPasswordHasher->hashPassword($partner, $password);
            $form->getData()->setPassword($hash);
        };
    }

    
   
}
