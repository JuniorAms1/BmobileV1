<?php

namespace App\Controller;

use App\Model\Search;
use App\Entity\Enseigne;
use App\Form\SearchType;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EnseigneController extends AbstractController
{
    #[Route('/enseigne', name: 'app_enseignes')]
    public function index(ManagerRegistry $doctrine, Request $request, PaginatorInterface $paginator): Response
    {
        $best_enseignes = $doctrine->getRepository(Enseigne::class)->findByIsBest(1);

        $data_enseignes = $doctrine->getRepository(Enseigne::class)->findAll();

        // Pour la rechecrhe d'enseigne 
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data_enseignes = $doctrine->getRepository(Enseigne::class)->findWithSearch($search);
        }
        // Pour la pagination
        $enseignes = $paginator->paginate(
            $data_enseignes, /* query NOT result Cela fait que récupérer les enseignes mais ne les renvoie pas */
            $request->query->getInt('page', 1)/*page number*/,
            4/*limit per page*/
        );
       
        return $this->render('enseigne/index.html.twig', [
          
          'enseignes' => $enseignes,
          'best_enseignes' => $best_enseignes,
          'form' => $form->createView()
     
        ]);
    }

    #[Route('/enseigne/{slug}', name: 'app_enseigne')]
    public function show(ManagerRegistry $doctrine, $slug): Response
    {
        $enseigne = $doctrine->getRepository(Enseigne::class)->findOneBySlug($slug);
        
        if (!$enseigne) {
            return $this->redirectToRoute('app_enseignes');
        } else {
            # code...
        }
        

        return $this->render('enseigne/detail_enseigne.html.twig', [
          'enseigne' => $enseigne
        ]);
    }
}
