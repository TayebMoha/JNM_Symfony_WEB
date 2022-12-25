<?php

namespace App\Controller;

use App\Repository\LogementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation", name="reservation_")
 */

class LogementController extends AbstractController
{
    #[Route('/logement', name: 'app_logement')]
    public function index(LogementRepository $logementRepo,Request $request, EntityManagerInterface $entityManager): Response
    {
        //on appel la liste de tous les logements
        $logements = $logementRepo->findAll();

        return $this->render('logement/index.html.twig', [
            'logements' => $logements,
        ]);
    }
}
