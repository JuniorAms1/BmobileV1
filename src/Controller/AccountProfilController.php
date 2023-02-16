<?php

namespace App\Controller;


use App\Form\ChangeProfilType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountProfilController extends AbstractController
{
    #[Route('/compte/modifier-mon-profil', name: 'app_account_profil')]
    public function index(Request $request, 
    ManagerRegistry $doctrine): Response
    {
        $notification = null;
        #On appelle le formulaire et on le passe à la vue
        $user = $this->getUser();
        $form = $this->createForm(ChangeProfilType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $tel = $form->get('tel')->getData();
                $adresse = $form->get('adresse')->getData();
              
                $user->setTel($tel);
                $user->setAdresse($adresse);
                 # Enregistrer les infos recuperer dans notre BDD
                 $em = $doctrine->getManager();
                 $em ->flush();
                 $notification = "Vos informations ont bien été mis à jour.";
        
        
            }
       
        

        return $this->render('account/modifier_profil.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
