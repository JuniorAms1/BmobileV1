<?php

namespace App\Controller\Admin;

use App\Entity\EnseigneDetails;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EnseigneDetailsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EnseigneDetails::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('adresse'),
            TextField::new('siteweb'),
            TextField::new('email'),
            TextField::new('tel'),
            TextField::new('whatsapp')->hideOnIndex(),
            TextField::new('rs_facebook')->hideOnIndex(),
            TextField::new('rs_insta')->hideOnIndex(),
            TextField::new('rs_twitter')->hideOnIndex(),
            ImageField::new('first_illustration', 'Produits')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            ImageField::new('second_illustration')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[contenthash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),
            ImageField::new('third_illustration')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[contenthash].[extension]')
                ->setRequired(false)
                ->hideOnIndex(),
            ImageField::new('catalogue')
                ->setBasePath('uploads/')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[contenthash].[extension]'),
            TextareaField::new('a_propos')->hideOnIndex(),
            UrlField::new('map_localisation')->hideOnIndex(),
            AssociationField::new('enseigne') 
        ];
    }
    
}
