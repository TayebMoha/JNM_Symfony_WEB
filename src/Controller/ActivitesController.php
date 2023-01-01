<?php

namespace App\Controller;

use App\Form\ActiviteFormType;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/reservation", name="reservation_")
 */

class ActivitesController extends AbstractController
{
    #[Route('/activites', name: 'app_activites')]
    public function index(ActiviteRepository $activiteRepo, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ActiviteFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($user);
            $entityManager->flush();
        }

        $activites = $activiteRepo->findAll();

        return $this->render('activites/index.html.twig', [
            'activites' => $activites,
            'activiteForm'=>$form->createView(),
        ]);
    }
}

