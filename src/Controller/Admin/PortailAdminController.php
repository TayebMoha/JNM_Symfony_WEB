<?php

namespace App\Controller\Admin;

use App\Entity\Activite;
use App\Entity\Contact;
use App\Entity\Logement;
use App\Entity\Navigo;
use App\Entity\Utilisateur;
use App\Entity\Video;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PortailAdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('JNM-Admin')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Messages', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Concours', 'fas fa-video', Video::class);
        yield MenuItem::linkToCrud('Logements', 'fas fa-hotel', Logement::class);
        yield MenuItem::linkToCrud('Navigos', 'fas fa-train', Navigo::class);
        yield MenuItem::linkToCrud('Activités', 'fas fa-gamepad', Activite::class);

    }
}
