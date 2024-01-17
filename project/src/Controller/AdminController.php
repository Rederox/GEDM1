<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'acceuil_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('admin/products', name: 'products_admin')]
    public function products(): Response
    {
        return $this->render('admin/fds/showProducts.html.twig', [
            'controller_name' => 'AdminController',
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
