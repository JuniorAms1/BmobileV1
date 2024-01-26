<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories', name: 'app_categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/{slug}', name: 'list')]
    public function index(Categories $categorie): Response
    {

            
        //On va chercher la liste des enseignes de la catégorie
        $enseignes = $categorie->getEnseignes();

        return $this->render('categories/list.html.twig', [
            'categorie' => $categorie,
            'enseignes' => $enseignes
        ]);
         // Syntaxe alternative
        //  return $this->render('categories/list.html.twig', compact('categorie', 'enseignes'));
    }
}
