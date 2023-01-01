<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenairesFormType;
use App\Repository\PartenaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NosPartenairesController extends AbstractController
{
    #[Route('/nospartenaires', name: 'app_nos_partenaires')]
    public function index(Request $request, EntityManagerInterface $entityManager, PartenaireRepository $partenaireRepo ): Response
    {
        $partenaire = new Partenaire();
        $form = $this->createForm(PartenairesFormType::class, $partenaire);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($partenaire);
            $entityManager->flush();
        }

        //on appel la liste de tous les partenaires
        $partenaires = $partenaireRepo->findAll();

        return $this->render('nos_partenaires/index.html.twig', [
            'partenaires' => $partenaires,
            'partenaireForm' => $form->createView()
        ]);

    }
}
