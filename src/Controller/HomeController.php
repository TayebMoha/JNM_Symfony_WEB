<?php

namespace App\Controller;

use App\Repository\PartenaireRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_homepage')]

    public function index(UtilisateurRepository $utilisateurRepository, PartenaireRepository $partenaireRepository): Response
    {
        $countusers= $utilisateurRepository->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();
        $countmiage=$utilisateurRepository->createQueryBuilder('b')
            ->select('count(distinct u.provenance)')
            ->from('App:Utilisateur','u')
            ->where("u.provenance LIKE 'MIAGE%'")
            ->getQuery()
            ->getSingleScalarResult();
        $countsponsors=$partenaireRepository->createQueryBuilder('c')
            ->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        return $this->render('home/index.html.twig', [
            'nbusers'=>$countusers,
            'nbsponsors'=>$countsponsors,
            'nbmiages'=>$countmiage,
        ]);
    }

}
