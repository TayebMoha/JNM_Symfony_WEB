<?php

namespace App\Controller;

use App\Form\LogementFormType;
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
        $user = $this->getUser();

        $form = $this->createForm(LogementFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($user);
            $entityManager->flush();
        }

        //on appel la liste de tous les logements
        $logements = $logementRepo->findAll();

        return $this->render('logement/index.html.twig', [
            'logements' => $logements,
            'logementForm'=>$form->createView(),
        ]);
    }
}
