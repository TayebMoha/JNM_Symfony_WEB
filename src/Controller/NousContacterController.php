<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NousContacterController extends AbstractController
{
    #[Route('/nouscontacter', name: 'app_nous_contacter')]
    public function index(): Response
    {
        return $this->render('nous_contacter/index.html.twig', [
            'controller_name' => 'NousContacterController',
        ]);
    }
}
