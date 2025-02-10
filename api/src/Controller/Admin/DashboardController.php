<?php

namespace App\Controller\Admin;
use App\Entity\Produits;
use App\Entity\Contact;
use App\Entity\User;
use App\Repository\ProduitsRepository;
use App\Controller\Admin\ProduitsCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Security\Http\Attribute\IsGranted;



#[IsGranted('ROLE_USER')]
class DashboardController extends AbstractDashboardController
{
    private ProduitsRepository $produitRepository;
    private AdminUrlGenerator $adminUrlGenerator;


    public function __construct(ProduitsRepository $produitsRepository, AdminUrlGenerator $adminUrlGenerator)
    {
        $this->produitRepository = $produitsRepository;
        $this->adminUrlGenerator = $adminUrlGenerator;


    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {        
        $total = count( $this->produitRepository->findAll());

        $newProductUrl = $this->adminUrlGenerator
        ->setController(ProduitsCrudController::class)
        ->setAction(Action::NEW)
        ->generateUrl();


        return $this->render('dashboard/index.html.twig', [
            'totalArticles' => $total,
            'newProductUrl' => $newProductUrl,

        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Art des Fils');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Tableau de Bord', 'fa fa-dashboard');

        yield MenuItem::linkToCrud('Produits', 'fas fa-list', Produits::class);
        yield MenuItem::linkToCrud('Contacts', 'fas fa-list', Contact::class);
        yield MenuItem::linkToCrud('User', 'fas fa-list', User::class);
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
            ->add(Crud::PAGE_INDEX, Action::DETAIL);

    }
}
