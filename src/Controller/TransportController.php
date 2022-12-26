<?php

namespace App\Controller;

use App\Repository\NavigoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/reservation", name="reservation_")
 */

class TransportController extends AbstractController
{
    #[Route('/transport', name: 'app_transport')]
    public function index(NavigoRepository $transportRepo,Request $request, EntityManagerInterface $entityManager): Response
    {
        //on appel la liste de tous les transports
        $transports = $transportRepo->findAll();

        return $this->render('transport/index.html.twig', [
            'transports' => $transports,
        ]);
    }
}
