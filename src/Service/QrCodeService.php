<?php

namespace App\Service;

use App\Entity\Membre;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Label\Margin\Margin;
use Doctrine\Persistence\ManagerRegistry;
use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class QrCodeService{

   
    private $builder;
    private $doctrine;

    public function __construct(BuilderInterface $builder, ManagerRegistry $doctrine)
    {
        $this->builder = $builder;
        $this->doctrine = $doctrine;
    }

    public function generateQrCode(Membre $user)
    {

        $qr_data = $user->getId();
        $qr_label = $user->getFirstname()." ".$user->getLastname();

        $path = dirname(__DIR__, 2).'/public/assets/';


        // set qrcode
        $result = $this->builder
            ->data($qr_data)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(300)
            ->margin(10)
            ->labelText($qr_label)
            ->labelAlignment(new LabelAlignmentCenter())
            ->labelMargin(new Margin(15, 5, 5, 5))
            ->logoPath($path.'img/logoofficiel.png')
            ->logoResizeToWidth('100')
            ->logoResizeToHeight('100')
            ->build()
        ;
       
         //generate name
        //$namePng = uniqid('', '') . '.png';
       

        //Save img png
      // $result->saveToFile($path.'qr-code/'.$namePng);

        return $result->getDataUri();
       
    }

    public function getName()
    {
            $namePng = uniqid('', '') . '.png';
            return $namePng;
      
    }


}