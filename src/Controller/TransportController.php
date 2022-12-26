<?php

namespace App\Controller;

use App\Form\NavigoType;
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
        $user = $this->getUser();
        $form = $this->createForm(NavigoType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('transport/index.html.twig', [
            'transports' => $transports,
            'form'=>$form->createView(),
        ]);
    }
}
