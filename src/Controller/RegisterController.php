<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\Membre;
use App\Form\RegisterType;
use App\Service\JWTService;
use App\Service\QrCodeService;
use App\Service\SendMailService;
use App\Repository\MembreRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{
       

    #[Route('/inscription', name: 'app_register')]
    public function index(
        Request $request, 
        ManagerRegistry $doctrine, 
        UserPasswordHasherInterface $encoder,
        SendMailService $mail,
        JWTService $jwt,
        QrCodeService $qrcodeService
        ): Response
    {
        $notification = null;
         # On instancie nos variable de qr
         $qrCode = null;
         $num_carte = null;
       
        $user = new Membre();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
            // Rappeller user et recuperer les données 
            $user = $form->getData();
 
            // Hasher ou encoder le mdp
          $password = $encoder->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($password);
     
           // Enregistrer les infos recuperer dans notre BDD
            $em = $doctrine->getManager();
            $em ->persist($user);
            $em ->flush();

            // On génère le JWT de l'utilisateur

                // On crée le Header
            $header = [
                'typ' => 'JWT',
                'alg' => 'HS256'
            ];
               // On crée le Payload
               $payload = [
                'user_id' => $user->getId()
            ];
            // On génère le token
            $token = $jwt->generate($header, $payload, $this->getParameter('app.jwtsecret'));
          
            // On envoie un mail
             $mail->send(
                'no-reply@bmobile.com',
                $user->getEmail(),
                'Activation de votre compte sur la plateforme B-mobile',
                'register',
                compact('user', 'token')
            );
              $notification = "Email de confirmation envoyé dans votre boîte mail! Confirmez et connectez-vous.";
              if($user){
                $num_carte = rand(1, 10000).rand(1,10000)."7575";
               
                $qrCode = $qrcodeService->generateQrCode($user);
                $qrImg = $qrcodeService->getName() ;
                 // Enregistrer les infos recuperer dans notre BDD
                    $carte = new Carte();
                    $carte->getId();
                    $carte->setMembre($user);
                    $carte->setNumCarte($num_carte);
                    $carte->setQr($qrImg);
                   
                    $em = $doctrine->getManager();
                    $em ->persist($carte);
                    $em ->flush();

            } 
              //return $this->redirectToRoute('app_login');
        }
        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification 
        ]);
    }

   
    
    #[Route('/verif/{token}', name: 'verify_user')]
    public function verifyUser($token,
        JWTService $jwt,
        MembreRepository $usersRepository, 
        ManagerRegistry $doctrine
        ): Response
    {
        $notification = null;
        //On vérifie si le token est valide, n'a pas expiré et n'a pas été modifié
        if($jwt->isValid($token) && !$jwt->isExpired($token) && $jwt->check($token, 
           $this->getParameter('app.jwtsecret'))){
            // On récupère le payload
            $payload = $jwt->getPayload($token);

            // On récupère le user du token
            $user = $usersRepository->find($payload['user_id']);

            //On vérifie que l'utilisateur existe et n'a pas encore activé son compte
            if($user && !$user->isIsverified()){
                $user->setIsVerified(true);
                $em = $doctrine->getManager();
                $em->flush($user);
                $notification = "Votre compte a été activé";
              
                return $this->redirectToRoute('app_account');
            }
        }
        // Ici un problème se pose dans le token
        $notification = "Le token est invalide ou a expiré";
        return $this->redirectToRoute('app_login', [
            'notification' => $notification,
        ]);
    }
}

