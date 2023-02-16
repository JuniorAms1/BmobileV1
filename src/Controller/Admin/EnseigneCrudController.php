<?php

namespace App\Controller\Admin;

use App\Entity\Enseigne;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\PercentField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class EnseigneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Enseigne::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('nom'),
            SlugField::new('slug')
                ->setTargetFieldName('nom'),
            ImageField::new('logo')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[contenthash].[extension]')
                ->setRequired(false),
            TextField::new('ville'),
            TextareaField::new('description'),
            PercentField::new('remise'),
            BooleanField::new('is_best'),
            MoneyField::new('prix_public')
                ->setCurrency('XOF'),
            AssociationField::new('categorie') 
        
        ];
    }
    
}

/*
 return [
           
            TextField::new('name'),
            SlugField::new('slug')
                ->setTargetFieldName('name'),
            ImageField::new('illustration')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[contenthash].[extension]')
                ->setRequired(false),
            TextField::new('substitle'),
            TextareaField::new('description'),
            MoneyField::new('price')
                ->setCurrency('XOF'),
            AssociationField::new('category') 
            
        ];
*/