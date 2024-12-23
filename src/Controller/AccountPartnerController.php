<?php

namespace App\Controller;


use App\Entity\Carte;
use App\Entity\Membre;
use DateTimeImmutable;
use App\Entity\Partner;
use App\Entity\Structure;
use App\Entity\Frequentation;
use App\Form\FrequentationType;
use App\Form\MakePartnerOfferType;
use App\Form\ChangePartnerPasswordType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class AccountPartnerController extends AbstractController
{
    #[Route('/partner', name: 'app_account_partner')]
    public function index(): Response
    {        
        return $this->render('accountPartner/index.html.twig');
    }

    #[Route('/partner/modifier-mes-infos', name: 'app_account_partner_modify')]
    public function modify(
        Request $request, 
        ManagerRegistry $doctrine,
        UserPasswordHasherInterface $encoder
    ): Response
    {        
        $notification = null;
        #On appelle le formulaire et on le passe à la vue
        $partner = $this->getUser();
        $form = $this->createForm(ChangePartnerPasswordType::class, $partner);

         #Traiter le formulaire de modification de mdp
         $form ->handleRequest($request);

         if ($form->isSubmitted() && $form->isValid()) {
            $old_pwd = $form->get('old_password')->getData();
            if ($encoder->isPasswordValid($partner, $old_pwd)) {
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($partner, $new_pwd);
                $partner->setPassword($password);

                 # Enregistrer les infos recuperer dans notre BDD
                 $em = $doctrine->getManager();
                 $em ->flush();
                 $notification = "Vos informations ont bien été mis à jour.";
            } else{

                $notification = "Votre mot de passe actuel n'est pas le bon";
        
            }

         }
       
        
        return $this->render('accountPartner/modify.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }

    #[Route('/partner/lancer-une-offre', name: 'app_account_partner_offer')]
    public function lancerOffre(
        Request $request, 
        ManagerRegistry $doctrine
       ): Response
    {
        $notification = null;
        #On appelle le formulaire et on le passe à la vue
        $partner = $this->getUser();
        $form = $this->createForm(MakePartnerOfferType::class, $partner);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $offre = $form->get('offre')->getData();
                
              
                $partner->setOffre($offre);
              
                 # Enregistrer les infos recuperer dans notre BDD
                 $em = $doctrine->getManager();
                 $em ->flush();
                 $notification = "Votre offre a bien été enregistrer";
        
        
            }
        

        return $this->render('accountPartner/lancer_offre.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }

    #[Route('/partner/scanner-qr', name: 'app_scanqr')]
    public function scannerQr(
        Request $request, 
        ManagerRegistry $doctrine
       ): Response
    {
        $notification = null;
        $em = $doctrine->getManager();
        $structure = 1;
        $membre = 24;
        
        #On appelle le formulaire de frequentation et on le passe à la vue
        $frequentation = new Frequentation();
        $form = $this->createForm(FrequentationType::class, $frequentation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                $montant = $form->get('montant')->getData();
                $date = new DateTimeImmutable();
              
              
                $frequentation->setMontant($montant);
                $frequentation->setDateFreq($date);
                $frequentation->setStructure($structure);
                $frequentation->setMembre($membre);
              
           
              
                 # Enregistrer les infos recuperer dans notre BDD
                 $em ->persist($frequentation);
                 $em ->flush();
                $notification = "Achat sauvegarder avec succés";
        
            }

       
        
       

        return $this->render('accountPartner/scan_qr.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }

    
}
