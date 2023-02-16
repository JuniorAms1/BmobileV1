<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    #[Route('/compte/modifier-mon-mot-de-passe', name: 'app_account_password')]
    public function index(Request $request, 
    ManagerRegistry $doctrine,
    UserPasswordHasherInterface $encoder): Response
    {
        $notification = null;
        #On appelle le formulaire et on le passe à la vue
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

         #Traiter le formulaire de modification de mdp
         $form ->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($user, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user, $new_pwd);
                $user->setPassword($password);

                 # Enregistrer les infos recuperer dans notre BDD
                 $em = $doctrine->getManager();
                 $em ->flush();
                 $notification = "Votre mot de passe a bien été mis à jour.";
            } else{

                $notification = "Votre mot de passe actuel n'est pas le bon";
        
            }

         }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}
