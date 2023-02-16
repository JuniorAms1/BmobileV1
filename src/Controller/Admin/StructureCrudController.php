<?php

namespace App\Controller\Admin;

use App\Entity\Structure;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StructureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Structure::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            TextField::new('adresse'),
            AssociationField::new('enseigne') 
        ];
    }
   
}
