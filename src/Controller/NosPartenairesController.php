<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NosPartenairesController extends AbstractController
{
    #[Route('/nospartenaires', name: 'app_nos_partenaires')]
    public function index(): Response
    {
        return $this->render('nos_partenaires/index.html.twig', [
            'controller_name' => 'NosPartenairesController',
        ]);
    }
}
