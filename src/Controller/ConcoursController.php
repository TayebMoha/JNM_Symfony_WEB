<?php

namespace App\Controller;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\VideoType;

class ConcoursController extends AbstractController
{
    #[Route('/concours', name: 'app_concours')]
    public function index(Request $request, EntityManagerInterface $entityManager, VideoRepository $videoRepository): Response
    {
        $user = $this->getUser();
        $video = $user->getRefVideo();

        $form = $this->createForm(VideoType::class, $video);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($video);
            $entityManager->flush();
        }

        $aixMarseille=$videoRepository->findOneBy(['miage' => 'MIAGE Aix Marseille']);
        $amiens=$videoRepository->findOneBy(['miage' => 'MIAGE Amiens']);
        $antilles=$videoRepository->findOneBy(['miage' => 'MIAGE Antilles']);
        $bordeaux=$videoRepository->findOneBy(['miage' => 'MIAGE Bordeaux']);
        $grenoble=$videoRepository->findOneBy(['miage' => 'MIAGE Grenoble']);
        $lille=$videoRepository->findOneBy(['miage' => 'MIAGE Lille']);
        $lyon=$videoRepository->findOneBy(['miage' => 'MIAGE Lyon']);
        $mulhouse=$videoRepository->findOneBy(['miage' => 'MIAGE Mulhouse']);
        $nancy=$videoRepository->findOneBy(['miage' => 'MIAGE Nancy']);
        $nantes=$videoRepository->findOneBy(['miage' => 'MIAGE Nantes']);
        $nice=$videoRepository->findOneBy(['miage' => 'MIAGE Nice']);
        $nouvCal=$videoRepository->findOneBy(['miage' => 'MIAGE Nouvelle-Calédonie']);
        $orleans=$videoRepository->findOneBy(['miage' => 'MIAGE Orléans']);
        $parisDauphine=$videoRepository->findOneBy(['miage' => 'MIAGE Paris Dauphine']);
        $parisDescartes=$videoRepository->findOneBy(['miage' => 'MIAGE Paris Descartes']);
        $parisNanterre=$videoRepository->findOneBy(['miage' => 'MIAGE Paris Nanterre']);
        $parisEvry=$videoRepository->findOneBy(['miage' => 'MIAGE Paris Saclay/Evry']);
        $parisOrsay=$videoRepository->findOneBy(['miage' => 'MIAGE Paris Saclay/Orsay']);
        $parisSorbonne=$videoRepository->findOneBy(['miage' => 'MIAGE Paris Sorbonne']);
        $rennes=$videoRepository->findOneBy(['miage' => 'MIAGE Rennes']);
        $toulouse=$videoRepository->findOneBy(['miage' => 'MIAGE Toulouse']);

        return $this->render('concours/index.html.twig', [
            'form'=>$form->createView(),
            'aixMarseille'=>$aixMarseille->getLien(),
            'noteAix'=>$aixMarseille->getScore(),
            'amiens'=>$amiens->getLien(),
            'noteAmiens'=>$amiens->getScore(),
            'antilles'=>$antilles->getLien(),
            'noteAntilles'=>$antilles->getScore(),
            'bordeaux'=>$bordeaux->getLien(),
            'noteBordeaux'=>$bordeaux->getScore(),
            'grenoble'=>$grenoble->getLien(),
            'noteGrenoble'=>$grenoble->getScore(),
            'lille'=>$lille->getLien(),
            'noteLille'=>$lille->getScore(),
            'lyon'=>$lyon->getLien(),
            'noteLyon'=>$lyon->getScore(),
            'mulhouse'=>$mulhouse->getLien(),
            'noteMulhouse'=>$mulhouse->getScore(),
            'nancy'=>$nancy->getLien(),
            'noteNancy'=>$nancy->getScore(),
            'nantes'=>$nantes->getLien(),
            'noteNantes'=>$nantes->getScore(),
            'nice'=>$nice->getLien(),
            'noteNice'=>$nice->getScore(),
            'nouvCal'=>$nouvCal->getLien(),
            'noteCal'=>$nouvCal->getScore(),
            'orleans'=>$orleans->getLien(),
            'noteOrleans'=>$orleans->getScore(),
            'parisDauphine'=>$parisDauphine->getLien(),
            'noteDauphine'=>$parisDauphine->getScore(),
            'parisDescartes'=>$parisDescartes->getLien(),
            'noteDescartes'=>$parisDescartes->getScore(),
            'parisNanterre'=>$parisNanterre->getLien(),
            'noteNanterre'=>$parisNanterre->getScore(),
            'parisEvry'=>$parisEvry->getLien(),
            'noteEvry'=>$parisEvry->getScore(),
            'parisOrsay'=>$parisOrsay->getLien(),
            'noteOrsay'=>$parisOrsay->getScore(),
            'parisSorbonne'=>$parisSorbonne->getLien(),
            'noteSorbonne'=>$parisSorbonne->getScore(),
            'rennes'=>$rennes->getLien(),
            'noteRennes'=>$rennes->getScore(),
            'toulouse'=>$toulouse->getLien(),
            'noteToulouse'=>$toulouse->getScore(),
        ]);
    }
}
