<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\Membre;
use App\Service\QrCodeService;
use DateTimeImmutable;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        
        return $this->render('account/index.html.twig');
    }

    #[Route('/compte/mon-qr-codes', name: 'app_qr_codes')]
    public function monQr(
        ManagerRegistry $doctrine,
        QrCodeService $qrcodeService,
        
        ): Response
    {
        # On instancie nos variable de qr
        $qrCode = null;
      
        $user = $this->getUser();
       
        $qrCode = $qrcodeService->generateQrCode($user);
      

        
        return $this->render('account/mon_qr.html.twig', [
            'qrCode' => $qrCode
        ]);
    }

    #[Route('/compte/mon-statut', name: 'app_account_status')]
    public function monStatut(
        ManagerRegistry $doctrine,
      
        
        ): Response
    {
       
        $em = $doctrine->getManager();
        $carte = $em->getRepository(Carte::class)->findByMembre($this->getUser());
       

        
        return $this->render('account/statut.html.twig', [
           'cartes' => $carte
          
        ]);
    }
}
