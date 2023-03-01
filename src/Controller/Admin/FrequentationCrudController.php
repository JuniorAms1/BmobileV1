<?php

namespace App\Controller\Admin;

use App\Entity\Frequentation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class FrequentationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Frequentation::class;
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
            NumberField::new('montant', 'Montant Achat en CFA'),
            DateField::new('date_freq', 'Date du'),
            NumberField::new('structure'),
            NumberField::new('membre')
            
        ];
    }
   
}
