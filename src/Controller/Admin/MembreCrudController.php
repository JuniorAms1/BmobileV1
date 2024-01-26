<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MembreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Membre::class;
    }

    public function configureActions(Actions $actions): Actions
        {
            return $actions
                // ...
                ->add('index', 'detail')
                ->setPermission(Action::NEW, 'ROLE_ADMIN')
                ->setPermission(Action::EDIT, 'ROLE_ADMIN')
                ->setPermission(Action::DELETE, 'ROLE_ADMIN')
            ;
        }


   
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            EmailField::new('email'),
            TelephoneField::new('tel'),
            TextField::new('adresse'),
            DateField::new('birthday', 'Né le')->onlyOnDetail(),
            DateField::new('created_at', 'Inscrit le')->onlyOnDetail(),
            TextField::new('mode_paiement')->onlyOnDetail(),
            NumberField::new('referal_code')->onlyOnDetail(),
            AssociationField::new('parrain')->onlyOnDetail(),
            BooleanField::new('isverified')->onlyOnDetail(),
           
           
        ];
    }
    
}
