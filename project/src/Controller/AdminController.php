<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'acceuil_admin')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userCount = $entityManager->getRepository(User::class)->count(['role' => 'ROLE_USER']);
        $productCount = $entityManager->getRepository(Product::class)->count([]);
        return $this->render('admin/index.html.twig', [
            'homeInformations' => [
                'userCount' => $userCount,
                'productCount' => $productCount,
            ],
        ]);
    }

    #[Route('admin/products', name: 'products_admin')]
    public function products(Request $request, EntityManagerInterface $entityManager, PaginatorInterface $paginator): Response
    {
        $queryBuilder = $entityManager->getRepository(Product::class)->createQueryBuilder('p');

        // Récupérer le terme de recherche
        $search = $request->query->get('search');
        if ($search) {
            $queryBuilder->where('p.product_name LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $search . '%');
        }

        $pagination = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            10
        );
        // dump($pagination);
        return $this->render('admin/fds/showProducts.html.twig', [
            'pagination' => $pagination,
        ]);
    }


    #[Route('admin/products/add', name: 'add_product_admin')]
    public function addProduct(): Response
    {
        return $this->render('admin/fds/addProduct.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('admin/products/edit', name: 'edit_product_admin')]
    public function editProduct(): Response
    {
        return $this->render('admin/fds/editProduct.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
