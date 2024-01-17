<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Product;
use App\Form\ProductsType;
use App\Repository\ProductRepository;

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
    public function addProduct(EntityManagerInterface $em, Request $request): Response
    {
        $product = new Product();

        $productForm = $this->createForm(ProductsType::class, $product);

        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid()){

        $file = $form->get('file')->getData();
        
        $em->persist($product);
        $em->flush();

        
        }

        $this->addFlash('success', 'Produit ajouté avec succès');

    
       
        return $this->render('admin/fds/addProduct.html.twig', [
            'productForm' => $productForm->createView()
        ]);
    }

    #[Route('admin/products/edit/{id}', name: 'edit_product_admin')]
    public function editProduct(Product $product, Request $request, EntityManagerInterface $em): Response
    {
        $productForm = $this->createForm(ProductsType::class, $product);

        $productForm->handleRequest($request);

        if($productForm->isSubmitted() && $productForm->isValid()){

        $em->persist($product);
        $em->flush();

        }

        $this->addFlash('success', 'Produit modifié avec succès');



        return $this->render('admin/fds/editProduct.html.twig', [
            'productForm' => $productForm->createView(),
            'product' => $product,
        ]);
    }
}
